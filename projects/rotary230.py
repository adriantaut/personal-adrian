#!/usr/bin/env python3
"""Generate Rotary 230 Instagram post and story designs."""

from PIL import Image, ImageDraw, ImageFont, ImageFilter
import os

LOGO_PATH = "/home/ubuntu/.openclaw/media/inbound/d715bb68-e133-49ed-a98d-d7d37bb2be32.png"
OUT_DIR = "/home/ubuntu/.openclaw/workspace-personal/output"

# Colors
NAVY_TOP = (18, 25, 45)
NAVY_BOT = (12, 18, 35)
GOLD = (200, 170, 80)
WHITE = (255, 255, 255)
LIGHT_GRAY = (180, 190, 210)

FONT_BOLD = "/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf"
FONT_REG = "/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf"


def gradient(draw, w, h, top, bot):
    for y in range(h):
        r = int(top[0] + (bot[0] - top[0]) * y / h)
        g = int(top[1] + (bot[1] - top[1]) * y / h)
        b = int(top[2] + (bot[2] - top[2]) * y / h)
        draw.line([(0, y), (w, y)], fill=(r, g, b))


def gold_line(draw, cx, y, length=300, width=2):
    draw.line([(cx - length // 2, y), (cx + length // 2, y)], fill=GOLD, width=width)


def centered_text(draw, text, y, font, fill=WHITE):
    bbox = draw.textbbox((0, 0), text, font=font)
    tw = bbox[2] - bbox[0]
    return draw.text(((draw.im.size[0] - tw) // 2, y), text, font=font, fill=fill)


def draw_badge(draw, cx, y, text, font):
    bbox = draw.textbbox((0, 0), text, font=font)
    tw, th = bbox[2] - bbox[0], bbox[3] - bbox[1]
    pad_x, pad_y = 30, 12
    x1 = cx - tw // 2 - pad_x
    y1 = y
    x2 = cx + tw // 2 + pad_x
    y2 = y + th + pad_y * 2
    draw.rounded_rectangle([x1, y1, x2, y2], radius=8, outline=GOLD, width=2)
    draw.text((cx - tw // 2, y + pad_y), text, font=font, fill=GOLD)
    return y2


def paste_logo(img, max_w, y_center):
    logo = Image.open(LOGO_PATH).convert("RGBA")
    ratio = max_w / logo.width
    new_size = (int(logo.width * ratio), int(logo.height * ratio))
    logo = logo.resize(new_size, Image.LANCZOS)
    x = (img.width - logo.width) // 2
    y = y_center - logo.height // 2
    img.paste(logo, (x, y), logo)
    return y + logo.height


def make_post():
    W, H = 1080, 1080
    img = Image.new("RGB", (W, H))
    draw = ImageDraw.Draw(img)
    gradient(draw, W, H, NAVY_TOP, NAVY_BOT)

    # Logo
    logo_bottom = paste_logo(img, 320, 160)
    draw = ImageDraw.Draw(img)  # refresh after paste

    cx = W // 2

    # Gold line
    gold_line(draw, cx, logo_bottom + 30)

    # Main text - new message
    font_main = ImageFont.truetype(FONT_BOLD, 38)
    line1 = "AJUTĂ-NE GRATUIT"
    line2 = "REDIRECȚIONÂND"
    
    y = logo_bottom + 55
    centered_text(draw, line1, y, font_main, fill=GOLD)
    y += 52
    centered_text(draw, line2, y, font_main, fill=GOLD)

    # Big 3.5%
    font_big = ImageFont.truetype(FONT_BOLD, 140)
    y += 65
    centered_text(draw, "3,5%", y, font_big, fill=WHITE)

    # Subtitle
    font_sub = ImageFont.truetype(FONT_REG, 32)
    y += 155
    centered_text(draw, "din impozitul pe venit", y, font_sub, fill=LIGHT_GRAY)

    # Gold line
    y += 55
    gold_line(draw, cx, y)

    # Formular 230 badge
    font_badge = ImageFont.truetype(FONT_BOLD, 34)
    y += 30
    draw_badge(draw, cx, y, "Formular 230", font_badge)

    img.save(os.path.join(OUT_DIR, "rotary-230-post.png"), quality=95)
    print("Post saved.")


def make_story():
    W, H = 1080, 1920
    img = Image.new("RGB", (W, H))
    draw = ImageDraw.Draw(img)
    gradient(draw, W, H, NAVY_TOP, NAVY_BOT)

    # Logo
    logo_bottom = paste_logo(img, 350, 200)
    draw = ImageDraw.Draw(img)

    cx = W // 2

    # Gold line
    gold_line(draw, cx, logo_bottom + 35, length=350)

    # Main text
    font_main = ImageFont.truetype(FONT_BOLD, 42)
    y = logo_bottom + 65
    centered_text(draw, "AJUTĂ-NE GRATUIT", y, font_main, fill=GOLD)
    y += 58
    centered_text(draw, "REDIRECȚIONÂND", y, font_main, fill=GOLD)

    # Big 3.5%
    font_big = ImageFont.truetype(FONT_BOLD, 170)
    y += 70
    centered_text(draw, "3,5%", y, font_big, fill=WHITE)

    # Subtitle
    font_sub = ImageFont.truetype(FONT_REG, 36)
    y += 185
    centered_text(draw, "din impozitul pe venit", y, font_sub, fill=LIGHT_GRAY)

    # Gold line
    y += 60
    gold_line(draw, cx, y, length=350)

    # Formular 230 badge
    font_badge = ImageFont.truetype(FONT_BOLD, 38)
    y += 35
    badge_bottom = draw_badge(draw, cx, y, "Formular 230", font_badge)

    # URL
    font_url = ImageFont.truetype(FONT_REG, 24)
    y = badge_bottom + 40
    centered_text(draw, "redirectioneaza.ro/rotary-club-cluj-napoca-opera", y, font_url, fill=LIGHT_GRAY)

    # Leave bottom ~600px empty for Instagram URL sticker

    img.save(os.path.join(OUT_DIR, "rotary-230-story.png"), quality=95)
    print("Story saved.")


if __name__ == "__main__":
    os.makedirs(OUT_DIR, exist_ok=True)
    make_post()
    make_story()
