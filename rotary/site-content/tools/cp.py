# cPanel UAPI/API2 helpers (token in ~/.rotary_cpanel_token, never in the repo)
import json, os, urllib.request, urllib.parse
tok = open(os.path.expanduser('~/.rotary_cpanel_token')).read().strip()
H = {'Authorization': f'cpanel rotaryop:{tok}'}
BASE = 'https://hv115.c-f.ro:2083'
def uapi(mod, fn, **p):
    u = f'{BASE}/execute/{mod}/{fn}?' + urllib.parse.urlencode(p)
    return json.loads(urllib.request.urlopen(urllib.request.Request(u, headers=H), timeout=300).read())
def api2(mod, fn, **p):
    p.update(cpanel_jsonapi_apiversion=2, cpanel_jsonapi_module=mod, cpanel_jsonapi_func=fn)
    u = f'{BASE}/json-api/cpanel?' + urllib.parse.urlencode(p)
    return json.loads(urllib.request.urlopen(urllib.request.Request(u, headers=H), timeout=300).read())['cpanelresult']
def save(d, fn, content):
    r = json.loads(urllib.request.urlopen(urllib.request.Request(f'{BASE}/execute/Fileman/save_file_content',
        data=urllib.parse.urlencode({'dir': d, 'file': fn, 'content': content}).encode(), headers=H)).read())
    assert r['status'] == 1, r
