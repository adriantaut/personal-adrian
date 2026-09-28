#!/bin/sh
# usage: badge.sh in.jpg out.png  -> square 800px, circular crop, Rotary badge bottom-centre
S=800; B=$((S*27/100)); Y=$((S*865/1000 - B/2)); X=$(((S-B)/2))
magick "$1" -auto-orient -resize ${S}x${S}^ -gravity center -extent ${S}x${S} \
  \( -size ${S}x${S} xc:black -fill white -draw "circle $((S/2)),$((S/2)) $((S/2)),1" \) -alpha off -compose CopyOpacity -composite \
  \( "$(dirname "$0")/badge.png" -resize ${B}x${B} \) -gravity northwest -geometry +${X}+${Y} -compose over -composite "$2"
