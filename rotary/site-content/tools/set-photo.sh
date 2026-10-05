#!/bin/sh
# usage: set-photo.sh "Nume Membru" photo.png  -> uploads and sets it as the member's photo (replaces old one)
set -e; D=$(dirname "$0"); F=$(basename "$2")
curl -s -m 120 -H "Authorization: cpanel rotaryop:$(cat ~/.rotary_cpanel_token)" -F "dir=/home/rotaryop/tmp" -F "overwrite=1" -F "file-1=@$2" "https://hv115.c-f.ro:2083/execute/Fileman/upload_files" >/dev/null
cd "$D" && python3 -c "
from oneshot import run; import sys
print(run(r'''require_once ABSPATH.\"wp-admin/includes/media.php\"; require_once ABSPATH.\"wp-admin/includes/file.php\"; require_once ABSPATH.\"wp-admin/includes/image.php\";
\$m=get_page_by_title(\"$1\",OBJECT,\"membru\"); if(!\$m){echo \"MISSING $1\";exit;} \$old=get_post_thumbnail_id(\$m->ID);
\$p=\"/home/rotaryop/tmp/$F\"; \$t=wp_tempnam(\"$F\"); copy(\$p,\$t); @unlink(\$p);
\$id=media_handle_sideload([\"name\"=>\"$F\",\"tmp_name\"=>\$t],\$m->ID,\"$1\"); set_post_thumbnail(\$m->ID,\$id); if(\$old) wp_delete_attachment(\$old,true); echo \"$1 -> \$id\";'''))"
