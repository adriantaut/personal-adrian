# helpers that emit valid core block markup for WordPress pages
import json
def j(a): return (' '+json.dumps(a,ensure_ascii=False)) if a else ''
def cls(*c): return ' '.join(x for x in c if x)
def p(t,c=''): a={'className':c} if c else {}; return f'<!-- wp:paragraph{j(a)} -->\n<p{f" class=\"{c}\"" if c else ""}>{t}</p>\n<!-- /wp:paragraph -->\n'
def h(t,l=2,c=''):
    a={}
    if l!=2: a['level']=l
    if c: a['className']=c
    return f'<!-- wp:heading{j(a)} -->\n<h{l} class="{cls("wp-block-heading",c)}">{t}</h{l}>\n<!-- /wp:heading -->\n'
def btn(t,u,style=''):
    a={'className':style} if style else {}
    return f'<!-- wp:button{j(a)} -->\n<div class="{cls("wp-block-button",style)}"><a class="wp-block-button__link wp-element-button" href="{u}">{t}</a></div>\n<!-- /wp:button -->\n'
def btns(*b): return '<!-- wp:buttons -->\n<div class="wp-block-buttons">'+''.join(b)+'</div>\n<!-- /wp:buttons -->\n'
def group(inner,c='',align='',tag='div',layout='constrained'):
    a={}
    if tag!='div': a['tagName']=tag
    if align: a['align']=align
    if c: a['className']=c
    a['layout']={'type':layout}
    return f'<!-- wp:group{j(a)} -->\n<{tag} class="{cls("wp-block-group","align"+align if align else "",c)}">{inner}</{tag}>\n<!-- /wp:group -->\n'
def cols(*cs,align='wide',c=''):
    a={}
    if align: a['align']=align
    if c: a['className']=c
    return f'<!-- wp:columns{j(a)} -->\n<div class="{cls("wp-block-columns","align"+align if align else "",c)}">'+''.join(cs)+'</div>\n<!-- /wp:columns -->\n'
def col(inner,c=''):
    a={'className':c} if c else {}
    return f'<!-- wp:column{j(a)} -->\n<div class="{cls("wp-block-column",c)}">{inner}</div>\n<!-- /wp:column -->\n'
def sep(): return '<!-- wp:separator {"className":"rop-hairline"} -->\n<hr class="wp-block-separator has-alpha-channel-opacity rop-hairline"/>\n<!-- /wp:separator -->\n'
def html(x): return f'<!-- wp:html -->\n{x}\n<!-- /wp:html -->\n'
def details(summary,inner): return f'<!-- wp:details -->\n<details class="wp-block-details"><summary>{summary}</summary>{inner}</details>\n<!-- /wp:details -->\n'
def pagehero(eyebrow,title,lead): return group(p(eyebrow,'rop-eyebrow')+h(title,1)+p(lead,'rop-lead'),c='rop-pagehero',align='full')
