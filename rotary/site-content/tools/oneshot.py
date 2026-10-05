# Run a one-off PHP snippet inside WordPress via a self-deleting, secret-guarded file
import secrets, urllib.request, sys
from cp import save
def run(php, timeout=300):
    k = secrets.token_hex(16); fn = f'tmp-{secrets.token_hex(8)}.php'
    src = (f"<?php if(!hash_equals('{k}',$_GET['k']??'')){{http_response_code(404);exit;}} @unlink(__FILE__); "
           "require __DIR__.'/wp-load.php'; require_once ABSPATH.'wp-admin/includes/admin.php'; "
           "wp_set_current_user(get_user_by('login','adrian.taut')->ID);\n" + php)
    save('/home/rotaryop/public_html', fn, src)
    return urllib.request.urlopen(f'https://rotaryoperacluj.ro/{fn}?k={k}', timeout=timeout).read().decode('utf-8', 'replace')
if __name__ == '__main__': print(run(open(sys.argv[1]).read()))
