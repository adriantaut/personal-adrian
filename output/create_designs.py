from PIL import Image, ImageDraw, ImageFont, ImageFilter
import os

LOGO_PATH = "/home/ubuntu/.openclaw/media/inbound/d715bb68-e133-49ed-a98d-d7d37bb2be32.png"
OUT_DIR = "/home/ubuntu/.openclaw/workspace-personal/output"

GOLD = (200, 169, 81)
NAVY_TOP = (15, 25, 55)
NAVY_BOT = (8, 14, 35)
WHITE = (255, 255, 255)
LIGHT_GRAY = (180, 190, 210)

def load_font(size, bold=True):
    paths = [
        "/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf" if bold else "/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf",
    ]
    for p in paths:
        if os.path.exists(p):
            return ImageFont.truetype(p, size)
    return ImageFont.load_default()

def gradient(draw, w, h):
    for y in range(h):
        r = int(NAVY_TOP[0] + (NAVY_BOT[0] - NAVY_TOP[0]) * y / h)
        g = int(NAVY_TOP[1] + (NAVY_BOT[1] - NAVY_TOP[1]) * y / h)
        b = int(NAVY_TOP[2] + (NAVY_BOT[2] - NAVY_TOP[2]) * y / h)
        draw.line([(0, y), (w, y)], fill=(r, g, b))

def center_text(draw, text, font, y, fill, w):
    bbox = draw.textbbox((0, 0), text, font=font)
    tw = bbox[2] - bbox[0]
    draw.text(((w - tw) / 2, y), text, font=font, fill=fill)

def gold_line(draw, y, w, length=400):
    x0 = (w - length) / 2
    draw.line([(x0, y), (x0 + length, y)], fill=GOLD, width=3)

def place_logo(img, max_h, y_offset):
    logo = Image.open(LOGO_PATH).convert("RGBA")
    ratio = max_h / logo.height
    new_w = int(logo.width * ratio)
    logo = logo.resize((new_w, max_h), Image.LANCZOS)
    x = (img.width - new_w) // 2
    img.paste(logo, (x, y_offset), logo)
    return y_offset + max_h

def draw_badge(draw, text, font, cx, cy, w):
    bbox = draw.textbbox((0, 0), text, font=font)
    tw, th = bbox[2] - bbox[0], bbox[3] - bbox[1]
    pad_x, pad_y = 30, 12
    x0 = cx - tw/2 - pad_x
    y0 = cy - pad_y
    x1 = cx + tw/2 + pad_x
    y1 = cy + th + pad_y
    draw.rounded_rectangle([x0, y0, x1, y1], radius=8, outline=GOLD, width=3)
    draw.text((cx - tw/2, cy), text, font=font, fill=GOLD)

# === POST 1080x1080 ===
W, H = 1080, 1080
img = Image.new("RGB", (W, H))
draw = ImageDraw.Draw(img)
gradient(draw, W, H)

y = place_logo(img, 180, 40)
draw = ImageDraw.Draw(img)  # refresh after paste

y += 30
gold_line(draw, y, W, 450)

# Main headline
y += 30
font_headline = load_font(72)
center_text(draw, "Donează, e gratuit!", font_headline, y, GOLD, W)

# 3.5%
y += 110
font_big = load_font(180)
center_text(draw, "3,5%", font_big, y, WHITE, W)

# sub text
y += 210
font_sub = load_font(36, bold=False)
center_text(draw, "din impozitul pe venit", font_sub, y, LIGHT_GRAY, W)

y += 60
gold_line(draw, y, W, 450)

# Redirecționează
y += 30
font_redir = load_font(32, bold=False)
center_text(draw, "Redirecționează prin", font_redir, y, LIGHT_GRAY, W)

# Badge
y += 60
font_badge = load_font(42)
draw_badge(draw, "Formular 230", font_badge, W/2, y, W)

img.save(os.path.join(OUT_DIR, "rotary-230-post.png"), "PNG")
print("Post saved.")

# === STORY 1080x1920 ===
W, H = 1080, 1920
img = Image.new("RGB", (W, H))
draw = ImageDraw.Draw(img)
gradient(draw, W, H)

y = place_logo(img, 200, 80)
draw = ImageDraw.Draw(img)

y += 50
gold_line(draw, y, W, 500)

# Main headline
y += 40
font_headline = load_font(76)
center_text(draw, "Donează, e gratuit!", font_headline, y, GOLD, W)

# 3.5%
y += 130
font_big = load_font(220)
center_text(draw, "3,5%", font_big, y, WHITE, W)

# sub text
y += 260
font_sub = load_font(40, bold=False)
center_text(draw, "din impozitul pe venit", font_sub, y, LIGHT_GRAY, W)

y += 70
gold_line(draw, y, W, 500)

# Redirecționează
y += 40
font_redir = load_font(36, bold=False)
center_text(draw, "Redirecționează prin", font_redir, y, LIGHT_GRAY, W)

# Badge
y += 65
font_badge = load_font(46)
draw_badge(draw, "Formular 230", font_badge, W/2, y, W)

# URL
y += 100
font_url = load_font(26, bold=False)
center_text(draw, "redirectioneaza.ro/rotary-club-cluj-napoca-opera", font_url, y, LIGHT_GRAY, W)

# Bottom left empty for URL sticker (~400px)

img.save(os.path.join(OUT_DIR, "rotary-230-story.png"), "PNG")
print("Story saved.")
