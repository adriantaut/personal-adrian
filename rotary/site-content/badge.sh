#!/bin/sh
# usage: badge.sh in.jpg out.png -> 800px circle photo, Rotary badge at the bottom edge (matches 2019-2024 member photos)
S=800; B=$((S*25/100)); Y=$((S*885/1000 - B/2)); X=$(((S-B)/2))
magick "$1" -auto-orient -resize ${S}x${S}^ -gravity center -extent ${S}x${S} \
  \( "$(dirname "$0")/badge.png" -resize ${B}x${B} \) -gravity northwest -geometry +${X}+${Y} -compose over -composite \
  \( -size ${S}x${S} xc:black -fill white -draw "circle $((S/2)),$((S/2)) $((S/2)),1" \) -alpha off -compose CopyOpacity -composite "$2"
