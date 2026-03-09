import { Composition } from "remotion";
import { AdrianIntro } from "./AdrianIntro";

export const RemotionRoot: React.FC = () => {
  return (
    <Composition
      id="AdrianIntro"
      component={AdrianIntro}
      durationInFrames={450}
      fps={30}
      width={1920}
      height={1080}
    />
  );
};
