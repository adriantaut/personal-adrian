import React from "react";
import {
  AbsoluteFill,
  interpolate,
  useCurrentFrame,
  spring,
  useVideoConfig,
  Sequence,
} from "remotion";

const ACCENT = "#00D4FF";
const ACCENT2 = "#FF6B35";
const BG = "#0a0a1a";

const SlideIn: React.FC<{
  children: React.ReactNode;
  delay?: number;
}> = ({ children, delay = 0 }) => {
  const frame = useCurrentFrame();
  const { fps } = useVideoConfig();
  const progress = spring({ frame: frame - delay, fps, config: { damping: 15, stiffness: 80 } });
  const opacity = interpolate(progress, [0, 1], [0, 1]);
  const translateY = interpolate(progress, [0, 1], [60, 0]);
  return (
    <div style={{ opacity, transform: `translateY(${translateY}px)` }}>
      {children}
    </div>
  );
};

const FadeOut: React.FC<{
  children: React.ReactNode;
  startFade: number;
  duration?: number;
}> = ({ children, startFade, duration = 10 }) => {
  const frame = useCurrentFrame();
  const opacity = interpolate(frame, [startFade, startFade + duration], [1, 0], {
    extrapolateLeft: "clamp",
    extrapolateRight: "clamp",
  });
  return <div style={{ opacity }}>{opacity > 0 ? children : null}</div>;
};

const Slide: React.FC<{
  emoji: string;
  title: string;
  subtitle?: string;
  accentColor?: string;
  slideDuration: number;
}> = ({ emoji, title, subtitle, accentColor = ACCENT, slideDuration }) => {
  const frame = useCurrentFrame();
  const { fps } = useVideoConfig();

  const fadeOut = interpolate(frame, [slideDuration - 12, slideDuration], [1, 0], {
    extrapolateLeft: "clamp",
    extrapolateRight: "clamp",
  });

  const barWidth = spring({ frame, fps, config: { damping: 20, stiffness: 60 } });

  return (
    <AbsoluteFill
      style={{
        backgroundColor: BG,
        justifyContent: "center",
        alignItems: "center",
        opacity: fadeOut,
      }}
    >
      {/* Decorative gradient orbs */}
      <div
        style={{
          position: "absolute",
          width: 500,
          height: 500,
          borderRadius: "50%",
          background: `radial-gradient(circle, ${accentColor}22 0%, transparent 70%)`,
          top: -100,
          right: -100,
        }}
      />
      <div
        style={{
          position: "absolute",
          width: 400,
          height: 400,
          borderRadius: "50%",
          background: `radial-gradient(circle, ${ACCENT2}15 0%, transparent 70%)`,
          bottom: -50,
          left: -50,
        }}
      />

      <div style={{ textAlign: "center", zIndex: 1 }}>
        <SlideIn>
          <div style={{ fontSize: 90, marginBottom: 20 }}>{emoji}</div>
        </SlideIn>
        <SlideIn delay={5}>
          <div
            style={{
              fontSize: 64,
              fontWeight: 800,
              color: "#ffffff",
              fontFamily: "Arial, Helvetica, sans-serif",
              letterSpacing: -1,
              maxWidth: 1400,
              lineHeight: 1.2,
            }}
          >
            {title}
          </div>
        </SlideIn>
        {subtitle && (
          <SlideIn delay={12}>
            <div
              style={{
                fontSize: 36,
                color: accentColor,
                fontFamily: "Arial, Helvetica, sans-serif",
                marginTop: 20,
                fontWeight: 500,
              }}
            >
              {subtitle}
            </div>
          </SlideIn>
        )}
        <SlideIn delay={8}>
          <div
            style={{
              width: interpolate(barWidth, [0, 1], [0, 200]),
              height: 4,
              background: `linear-gradient(90deg, ${accentColor}, ${ACCENT2})`,
              margin: "30px auto 0",
              borderRadius: 2,
            }}
          />
        </SlideIn>
      </div>
    </AbsoluteFill>
  );
};

export const AdrianIntro: React.FC = () => {
  const SLIDE = 56; // ~1.87s per slide, 8 slides = 15s

  return (
    <AbsoluteFill style={{ backgroundColor: BG }}>
      {/* Slide 1: Name intro */}
      <Sequence from={0} durationInFrames={SLIDE}>
        <Slide
          emoji="👋"
          title="Adrian Taut"
          subtitle="DevOps Engineer • Cluj-Napoca, Romania"
          slideDuration={SLIDE}
        />
      </Sequence>

      {/* Slide 2: Job */}
      <Sequence from={SLIDE} durationInFrames={SLIDE}>
        <Slide
          emoji="🏦"
          title="DevOps Engineer at ZAR"
          subtitle="Fintech"
          accentColor="#4ADE80"
          slideDuration={SLIDE}
        />
      </Sequence>

      {/* Slide 3: Company */}
      <Sequence from={SLIDE * 2} durationInFrames={SLIDE}>
        <Slide
          emoji="🚀"
          title="DevOps Box SRL"
          subtitle="Freelancing & Consulting"
          accentColor="#F59E0B"
          slideDuration={SLIDE}
        />
      </Sequence>

      {/* Slide 4: Hobbies */}
      <Sequence from={SLIDE * 3} durationInFrames={SLIDE}>
        <Slide
          emoji="🎾"
          title="Padel Player"
          subtitle="Rotary Club Opera Cluj-Napoca"
          accentColor="#EC4899"
          slideDuration={SLIDE}
        />
      </Sequence>

      {/* Slide 5: Motorcycle */}
      <Sequence from={SLIDE * 4} durationInFrames={SLIDE}>
        <Slide
          emoji="🏍️"
          title="Getting B125 License"
          subtitle="Future rider incoming"
          accentColor="#F97316"
          slideDuration={SLIDE}
        />
      </Sequence>

      {/* Slide 6: Trading */}
      <Sequence from={SLIDE * 5} durationInFrames={SLIDE}>
        <Slide
          emoji="📈"
          title="Trading Bots"
          subtitle="Automating the markets"
          accentColor="#8B5CF6"
          slideDuration={SLIDE}
        />
      </Sequence>

      {/* Slide 7: Motto */}
      <Sequence from={SLIDE * 6} durationInFrames={SLIDE}>
        <Slide
          emoji="⚡"
          title={`"Nothing is written by hand.`}
          subtitle='Everything is automated."'
          accentColor={ACCENT}
          slideDuration={SLIDE}
        />
      </Sequence>

      {/* Slide 8: Outro */}
      <Sequence from={SLIDE * 7} durationInFrames={SLIDE + 2}>
        <OutroSlide duration={SLIDE + 2} />
      </Sequence>
    </AbsoluteFill>
  );
};

const OutroSlide: React.FC<{ duration: number }> = ({ duration }) => {
  const frame = useCurrentFrame();
  const { fps } = useVideoConfig();
  const scale = spring({ frame, fps, config: { damping: 12, stiffness: 80 } });

  return (
    <AbsoluteFill
      style={{
        backgroundColor: BG,
        justifyContent: "center",
        alignItems: "center",
        background: `radial-gradient(ellipse at center, #0a0a2e 0%, ${BG} 70%)`,
      }}
    >
      <div style={{ textAlign: "center", transform: `scale(${scale})` }}>
        <div
          style={{
            fontSize: 72,
            fontWeight: 800,
            color: "#fff",
            fontFamily: "Arial, Helvetica, sans-serif",
          }}
        >
          Adrian Taut
        </div>
        <div
          style={{
            fontSize: 32,
            color: ACCENT,
            fontFamily: "Arial, Helvetica, sans-serif",
            marginTop: 15,
          }}
        >
          DevOps • Automation • Innovation
        </div>
        <SlideIn delay={10}>
          <div
            style={{
              width: 300,
              height: 4,
              background: `linear-gradient(90deg, ${ACCENT}, ${ACCENT2})`,
              margin: "25px auto 0",
              borderRadius: 2,
            }}
          />
        </SlideIn>
      </div>
    </AbsoluteFill>
  );
};
