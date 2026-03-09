#!/usr/bin/env python3
from PIL import Image, ImageDraw, ImageFont
import math, os

LOGO_PATH = "/home/ubuntu/.openclaw/media/inbound/d715bb68-e133-49ed-a98d-d7d37bb2be32.png"
OUT_DIR = "/home/ubuntu/.openclaw/workspace-personal/output"

GOLD = (200, 169, 81)
WHITE = (255, 255, 255)
NAVY_TOP = (10, 22, 40)
NAVY_BOT = (26, 42, 74)

def gradient_bg(w, h):
    img = Image.new("RGB", (w, h))
    for y in range(h):
        r = int(NAVY_TOP[0] + (NAVY_BOT[0] - NAVY_TOP[0]) * y / h)
        g = int(NAVY_TOP[1] + (NAVY_BOT[1] - NAVY_TOP[1]) * y / h)
        b = int(NAVY_TOP[2] + (NAVY_BOT[2] - NAVY_TOP[2]) * y / h)
        ImageDraw.Draw(img).line([(0, y), (w, y)], fill=(r, g, b))
    return img

def load_font(size, bold=True):
    paths = [
        "/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf" if bold else "/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf",
        "/usr/share/fonts/truetype/liberation/LiberationSans-Bold.ttf" if bold else "/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf",
    ]
    for p in paths:
        if os.path.exists(p):
            return ImageFont.truetype(p, size)
    return ImageFont.load_default()

def draw_heart(draw, cx, cy, size, color, width=3):
    """Draw a heart using line art"""
    points = []
    for i in range(200):
        t = math.pi * 2 * i / 200
        x = 16 * math.sin(t) ** 3
        y = -(13 * math.cos(t) - 5 * math.cos(2*t) - 2 * math.cos(3*t) - math.cos(4*t))
        points.append((cx + x * size / 16, cy + y * size / 16))
    draw.line(points + [points[0]], fill=color, width=width)

def draw_people(draw, cx, cy, scale, color, width=2):
    """Draw 5 simple people silhouettes holding hands"""
    spacing = 50 * scale
    for i in range(5):
        px = cx + (i - 2) * spacing
        # Head
        r = 8 * scale
        draw.ellipse([px-r, cy-45*scale-r, px+r, cy-45*scale+r], outline=color, width=width)
        # Body
        draw.line([(px, cy-37*scale), (px, cy-10*scale)], fill=color, width=width)
        # Legs
        draw.line([(px, cy-10*scale), (px-12*scale, cy+15*scale)], fill=color, width=width)
        draw.line([(px, cy-10*scale), (px+12*scale, cy+15*scale)], fill=color, width=width)
        # Arms (connect to neighbors)
        if i < 4:
            nx = cx + (i - 1) * spacing
            draw.line([(px+10*scale, cy-28*scale), (nx-10*scale, cy-28*scale)], fill=color, width=width)
        # Outer arms
        if i == 0:
            draw.line([(px-10*scale, cy-35*scale), (px-20*scale, cy-22*scale)], fill=color, width=width)
        if i == 4:
            draw.line([(px+10*scale, cy-35*scale), (px+20*scale, cy-22*scale)], fill=color, width=width)

def draw_separator(draw, cx, y, length, color):
    draw.line([(cx - length//2, y), (cx + length//2, y)], fill=color, width=2)

def place_logo(img, max_h, y_offset):
    logo = Image.open(LOGO_PATH).convert("RGBA")
    ratio = max_h / logo.height
    new_w = int(logo.width * ratio)
    logo = logo.resize((new_w, max_h), Image.LANCZOS)
    x = (img.width - new_w) // 2
    img.paste(logo, (x, y_offset), logo)
    return y_offset + max_h

def create_post():
    W, H = 1080, 1080
    img = gradient_bg(W, H)
    draw = ImageDraw.Draw(img)
    cx = W // 2

    # Logo
    y = 30
    y = place_logo(img, 130, y) + 15

    draw_separator(draw, cx, y, 300, GOLD)
    y += 25

    # REDIRECȚIONEAZĂ
    f = load_font(52)
    text = "REDIRECȚIONEAZĂ"
    bb = draw.textbbox((0,0), text, font=f)
    draw.text((cx - (bb[2]-bb[0])//2, y), text, fill=GOLD, font=f)
    y += (bb[3]-bb[1]) + 20

    # 3,5%
    f_big = load_font(180)
    text = "3,5%"
    bb = draw.textbbox((0,0), text, font=f_big)
    tw = bb[2] - bb[0]
    draw.text((cx - tw//2, y), text, fill=WHITE, font=f_big)
    y += bb[3] - bb[1] + 35

    # din impozitul pe venit
    f_sub = load_font(32, bold=False)
    text = "din impozitul pe venit"
    bb = draw.textbbox((0,0), text, font=f_sub)
    draw.text((cx - (bb[2]-bb[0])//2, y), text, fill=(180, 190, 210), font=f_sub)
    y += (bb[3]-bb[1]) + 20

    draw_separator(draw, cx, y, 300, GOLD)
    y += 25

    # Donează, e gratuit!
    f_don = load_font(38)
    text = "Donează, e gratuit!"
    bb = draw.textbbox((0,0), text, font=f_don)
    draw.text((cx - (bb[2]-bb[0])//2, y), text, fill=GOLD, font=f_don)
    y += (bb[3]-bb[1]) + 35

    # Heart + people illustration
    draw_heart(draw, cx - 130, y + 50, 35, GOLD, width=2)
    draw_people(draw, cx + 80, y + 55, 0.7, GOLD, width=2)
    draw_heart(draw, cx + 230, y + 50, 25, (*GOLD[:2], GOLD[2]//2 + 40), width=2)

    img.save(os.path.join(OUT_DIR, "rotary-230-post.png"), "PNG")
    print("Post saved.")

def create_story():
    W, H = 1080, 1920
    img = gradient_bg(W, H)
    draw = ImageDraw.Draw(img)
    cx = W // 2

    # Logo
    y = 60
    y = place_logo(img, 150, y) + 20

    draw_separator(draw, cx, y, 350, GOLD)
    y += 30

    # REDIRECȚIONEAZĂ
    f = load_font(58)
    text = "REDIRECȚIONEAZĂ"
    bb = draw.textbbox((0,0), text, font=f)
    draw.text((cx - (bb[2]-bb[0])//2, y), text, fill=GOLD, font=f)
    y += (bb[3]-bb[1]) + 30

    # 3,5%
    f_big = load_font(230)
    text = "3,5%"
    bb = draw.textbbox((0,0), text, font=f_big)
    tw = bb[2] - bb[0]
    draw.text((cx - tw//2, y), text, fill=WHITE, font=f_big)
    y += bb[3] - bb[1] + 45

    # din impozitul pe venit
    f_sub = load_font(38, bold=False)
    text = "din impozitul pe venit"
    bb = draw.textbbox((0,0), text, font=f_sub)
    draw.text((cx - (bb[2]-bb[0])//2, y), text, fill=(180, 190, 210), font=f_sub)
    y += (bb[3]-bb[1]) + 25

    draw_separator(draw, cx, y, 350, GOLD)
    y += 30

    # Donează, e gratuit!
    f_don = load_font(44)
    text = "Donează, e gratuit!"
    bb = draw.textbbox((0,0), text, font=f_don)
    draw.text((cx - (bb[2]-bb[0])//2, y), text, fill=GOLD, font=f_don)
    y += (bb[3]-bb[1]) + 50

    # Illustration - heart and people
    draw_heart(draw, cx, y + 60, 55, GOLD, width=3)
    draw_people(draw, cx, y + 170, 1.0, GOLD, width=2)
    y += 260

    # URL at bottom area (with space for sticker above)
    f_url = load_font(24, bold=False)
    url = "redirectioneaza.ro/rotary-club-cluj-napoca-opera"
    bb = draw.textbbox((0,0), url, font=f_url)
    draw.text((cx - (bb[2]-bb[0])//2, H - 120), url, fill=(150, 160, 180), font=f_url)

    # "Swipe up" hint area - leave space for IG sticker around y=1500-1700

    img.save(os.path.join(OUT_DIR, "rotary-230-story.png"), "PNG")
    print("Story saved.")

create_post()
create_story()
