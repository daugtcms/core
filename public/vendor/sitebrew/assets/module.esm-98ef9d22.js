function M(t){return t.split("-")[0]}function W(t){return t.split("-")[1]}function z(t){return["top","bottom"].includes(M(t))?"x":"y"}function it(t){return t==="y"?"height":"width"}function ct(t,e,n){let{reference:i,floating:s}=t;const o=i.x+i.width/2-s.width/2,r=i.y+i.height/2-s.height/2,l=z(e),c=it(l),f=i[c]/2-s[c]/2,d=M(e),u=l==="x";let a;switch(d){case"top":a={x:o,y:i.y-s.height};break;case"bottom":a={x:o,y:i.y+i.height};break;case"right":a={x:i.x+i.width,y:r};break;case"left":a={x:i.x-s.width,y:r};break;default:a={x:i.x,y:i.y}}switch(W(e)){case"start":a[l]-=f*(n&&u?-1:1);break;case"end":a[l]+=f*(n&&u?-1:1);break}return a}var Vt=async(t,e,n)=>{const{placement:i="bottom",strategy:s="absolute",middleware:o=[],platform:r}=n,l=await(r.isRTL==null?void 0:r.isRTL(e));if(r==null&&console.error(["Floating UI: `platform` property was not passed to config. If you","want to use Floating UI on the web, install @floating-ui/dom","instead of the /core package. Otherwise, you can create your own","`platform`: https://floating-ui.com/docs/platform"].join(" ")),o.filter(w=>{let{name:p}=w;return p==="autoPlacement"||p==="flip"}).length>1)throw new Error(["Floating UI: duplicate `flip` and/or `autoPlacement`","middleware detected. This will lead to an infinite loop. Ensure only","one of either has been passed to the `middleware` array."].join(" "));let c=await r.getElementRects({reference:t,floating:e,strategy:s}),{x:f,y:d}=ct(c,i,l),u=i,a={},m=0;for(let w=0;w<o.length;w++){if(m++,m>100)throw new Error(["Floating UI: The middleware lifecycle appears to be","running in an infinite loop. This is usually caused by a `reset`","continually being returned without a break condition."].join(" "));const{name:p,fn:y}=o[w],{x:h,y:g,data:v,reset:b}=await y({x:f,y:d,initialPlacement:i,placement:u,strategy:s,middlewareData:a,rects:c,platform:r,elements:{reference:t,floating:e}});if(f=h??f,d=g??d,a={...a,[p]:{...a[p],...v}},b){typeof b=="object"&&(b.placement&&(u=b.placement),b.rects&&(c=b.rects===!0?await r.getElementRects({reference:t,floating:e,strategy:s}):b.rects),{x:f,y:d}=ct(c,u,l)),w=-1;continue}}return{x:f,y:d,placement:u,strategy:s,middlewareData:a}};function Nt(t){return{top:0,right:0,bottom:0,left:0,...t}}function rt(t){return typeof t!="number"?Nt(t):{top:t,right:t,bottom:t,left:t}}function U(t){return{...t,top:t.y,left:t.x,right:t.x+t.width,bottom:t.y+t.height}}async function j(t,e){var n;e===void 0&&(e={});const{x:i,y:s,platform:o,rects:r,elements:l,strategy:c}=t,{boundary:f="clippingAncestors",rootBoundary:d="viewport",elementContext:u="floating",altBoundary:a=!1,padding:m=0}=e,w=rt(m),y=l[a?u==="floating"?"reference":"floating":u],h=U(await o.getClippingRect({element:(n=await(o.isElement==null?void 0:o.isElement(y)))==null||n?y:y.contextElement||await(o.getDocumentElement==null?void 0:o.getDocumentElement(l.floating)),boundary:f,rootBoundary:d,strategy:c})),g=U(o.convertOffsetParentRelativeRectToViewportRelativeRect?await o.convertOffsetParentRelativeRectToViewportRelativeRect({rect:u==="floating"?{...r.floating,x:i,y:s}:r.reference,offsetParent:await(o.getOffsetParent==null?void 0:o.getOffsetParent(l.floating)),strategy:c}):r[u]);return{top:h.top-g.top+w.top,bottom:g.bottom-h.bottom+w.bottom,left:h.left-g.left+w.left,right:g.right-h.right+w.right}}var xt=Math.min,D=Math.max;function et(t,e,n){return D(t,xt(e,n))}var yt=t=>({name:"arrow",options:t,async fn(e){const{element:n,padding:i=0}=t??{},{x:s,y:o,placement:r,rects:l,platform:c}=e;if(n==null)return console.warn("Floating UI: No `element` was passed to the `arrow` middleware."),{};const f=rt(i),d={x:s,y:o},u=z(r),a=it(u),m=await c.getDimensions(n),w=u==="y"?"top":"left",p=u==="y"?"bottom":"right",y=l.reference[a]+l.reference[u]-d[u]-l.floating[a],h=d[u]-l.reference[u],g=await(c.getOffsetParent==null?void 0:c.getOffsetParent(n)),v=g?u==="y"?g.clientHeight||0:g.clientWidth||0:0,b=y/2-h/2,R=f[w],P=v-m[a]-f[p],O=v/2-m[a]/2+b,_=et(R,O,P);return{data:{[u]:_,centerOffset:O-_}}}}),Ht={left:"right",right:"left",bottom:"top",top:"bottom"};function Y(t){return t.replace(/left|right|bottom|top/g,e=>Ht[e])}function vt(t,e,n){n===void 0&&(n=!1);const i=W(t),s=z(t),o=it(s);let r=s==="x"?i===(n?"end":"start")?"right":"left":i==="start"?"bottom":"top";return e.reference[o]>e.floating[o]&&(r=Y(r)),{main:r,cross:Y(r)}}var Dt={start:"end",end:"start"};function nt(t){return t.replace(/start|end/g,e=>Dt[e])}var bt=["top","right","bottom","left"],Ft=bt.reduce((t,e)=>t.concat(e,e+"-start",e+"-end"),[]);function Bt(t,e,n){return(t?[...n.filter(s=>W(s)===t),...n.filter(s=>W(s)!==t)]:n.filter(s=>M(s)===s)).filter(s=>t?W(s)===t||(e?nt(s)!==s:!1):!0)}var st=function(t){return t===void 0&&(t={}),{name:"autoPlacement",options:t,async fn(e){var n,i,s,o,r;const{x:l,y:c,rects:f,middlewareData:d,placement:u,platform:a,elements:m}=e,{alignment:w=null,allowedPlacements:p=Ft,autoAlignment:y=!0,...h}=t,g=Bt(w,y,p),v=await j(e,h),b=(n=(i=d.autoPlacement)==null?void 0:i.index)!=null?n:0,R=g[b];if(R==null)return{};const{main:P,cross:O}=vt(R,f,await(a.isRTL==null?void 0:a.isRTL(m.floating)));if(u!==R)return{x:l,y:c,reset:{placement:g[0]}};const _=[v[M(R)],v[P],v[O]],x=[...(s=(o=d.autoPlacement)==null?void 0:o.overflows)!=null?s:[],{placement:R,overflows:_}],E=g[b+1];if(E)return{data:{index:b+1,overflows:x},reset:{placement:E}};const A=x.slice().sort((C,L)=>C.overflows[0]-L.overflows[0]),T=(r=A.find(C=>{let{overflows:L}=C;return L.every(k=>k<=0)}))==null?void 0:r.placement,S=T??A[0].placement;return S!==u?{data:{index:b+1,overflows:x},reset:{placement:S}}:{}}}};function Wt(t){const e=Y(t);return[nt(t),e,nt(e)]}var At=function(t){return t===void 0&&(t={}),{name:"flip",options:t,async fn(e){var n;const{placement:i,middlewareData:s,rects:o,initialPlacement:r,platform:l,elements:c}=e,{mainAxis:f=!0,crossAxis:d=!0,fallbackPlacements:u,fallbackStrategy:a="bestFit",flipAlignment:m=!0,...w}=t,p=M(i),h=u||(p===r||!m?[Y(r)]:Wt(r)),g=[r,...h],v=await j(e,w),b=[];let R=((n=s.flip)==null?void 0:n.overflows)||[];if(f&&b.push(v[p]),d){const{main:x,cross:E}=vt(i,o,await(l.isRTL==null?void 0:l.isRTL(c.floating)));b.push(v[x],v[E])}if(R=[...R,{placement:i,overflows:b}],!b.every(x=>x<=0)){var P,O;const x=((P=(O=s.flip)==null?void 0:O.index)!=null?P:0)+1,E=g[x];if(E)return{data:{index:x,overflows:R},reset:{placement:E}};let A="bottom";switch(a){case"bestFit":{var _;const T=(_=R.map(S=>[S,S.overflows.filter(C=>C>0).reduce((C,L)=>C+L,0)]).sort((S,C)=>S[1]-C[1])[0])==null?void 0:_[0].placement;T&&(A=T);break}case"initialPlacement":A=r;break}if(i!==A)return{reset:{placement:A}}}return{}}}};function at(t,e){return{top:t.top-e.height,right:t.right-e.width,bottom:t.bottom-e.height,left:t.left-e.width}}function ft(t){return bt.some(e=>t[e]>=0)}var Rt=function(t){let{strategy:e="referenceHidden",...n}=t===void 0?{}:t;return{name:"hide",async fn(i){const{rects:s}=i;switch(e){case"referenceHidden":{const o=await j(i,{...n,elementContext:"reference"}),r=at(o,s.reference);return{data:{referenceHiddenOffsets:r,referenceHidden:ft(r)}}}case"escaped":{const o=await j(i,{...n,altBoundary:!0}),r=at(o,s.floating);return{data:{escapedOffsets:r,escaped:ft(r)}}}default:return{}}}}};function jt(t,e,n,i){i===void 0&&(i=!1);const s=M(t),o=W(t),r=z(t)==="x",l=["left","top"].includes(s)?-1:1,c=i&&r?-1:1,f=typeof n=="function"?n({...e,placement:t}):n;let{mainAxis:d,crossAxis:u,alignmentAxis:a}=typeof f=="number"?{mainAxis:f,crossAxis:0,alignmentAxis:null}:{mainAxis:0,crossAxis:0,alignmentAxis:null,...f};return o&&typeof a=="number"&&(u=o==="end"?a*-1:a),r?{x:u*c,y:d*l}:{x:d*l,y:u*c}}var _t=function(t){return t===void 0&&(t=0),{name:"offset",options:t,async fn(e){const{x:n,y:i,placement:s,rects:o,platform:r,elements:l}=e,c=jt(s,o,t,await(r.isRTL==null?void 0:r.isRTL(l.floating)));return{x:n+c.x,y:i+c.y,data:c}}}};function zt(t){return t==="x"?"y":"x"}var Ot=function(t){return t===void 0&&(t={}),{name:"shift",options:t,async fn(e){const{x:n,y:i,placement:s}=e,{mainAxis:o=!0,crossAxis:r=!1,limiter:l={fn:y=>{let{x:h,y:g}=y;return{x:h,y:g}}},...c}=t,f={x:n,y:i},d=await j(e,c),u=z(M(s)),a=zt(u);let m=f[u],w=f[a];if(o){const y=u==="y"?"top":"left",h=u==="y"?"bottom":"right",g=m+d[y],v=m-d[h];m=et(g,m,v)}if(r){const y=a==="y"?"top":"left",h=a==="y"?"bottom":"right",g=w+d[y],v=w-d[h];w=et(g,w,v)}const p=l.fn({...e,[u]:m,[a]:w});return{...p,data:{x:p.x-n,y:p.y-i}}}}},Et=function(t){return t===void 0&&(t={}),{name:"size",options:t,async fn(e){const{placement:n,rects:i,platform:s,elements:o}=e,{apply:r,...l}=t,c=await j(e,l),f=M(n),d=W(n);let u,a;f==="top"||f==="bottom"?(u=f,a=d===(await(s.isRTL==null?void 0:s.isRTL(o.floating))?"start":"end")?"left":"right"):(a=f,u=d==="end"?"top":"bottom");const m=D(c.left,0),w=D(c.right,0),p=D(c.top,0),y=D(c.bottom,0),h={height:i.floating.height-(["left","right"].includes(n)?2*(p!==0||y!==0?p+y:D(c.top,c.bottom)):c[u]),width:i.floating.width-(["top","bottom"].includes(n)?2*(m!==0||w!==0?m+w:D(c.left,c.right)):c[a])},g=await s.getDimensions(o.floating);r==null||r({...h,...i});const v=await s.getDimensions(o.floating);return g.width!==v.width||g.height!==v.height?{reset:{rects:!0}}:{}}}},Pt=function(t){return t===void 0&&(t={}),{name:"inline",options:t,async fn(e){var n;const{placement:i,elements:s,rects:o,platform:r,strategy:l}=e,{padding:c=2,x:f,y:d}=t,u=U(r.convertOffsetParentRelativeRectToViewportRelativeRect?await r.convertOffsetParentRelativeRectToViewportRelativeRect({rect:o.reference,offsetParent:await(r.getOffsetParent==null?void 0:r.getOffsetParent(s.floating)),strategy:l}):o.reference),a=(n=await(r.getClientRects==null?void 0:r.getClientRects(s.reference)))!=null?n:[],m=rt(c);function w(){if(a.length===2&&a[0].left>a[1].right&&f!=null&&d!=null){var y;return(y=a.find(h=>f>h.left-m.left&&f<h.right+m.right&&d>h.top-m.top&&d<h.bottom+m.bottom))!=null?y:u}if(a.length>=2){if(z(i)==="x"){const A=a[0],T=a[a.length-1],S=M(i)==="top",C=A.top,L=T.bottom,k=S?A.left:T.left,I=S?A.right:T.right,Z=I-k,tt=L-C;return{top:C,bottom:L,left:k,right:I,width:Z,height:tt,x:k,y:C}}const h=M(i)==="left",g=D(...a.map(A=>A.right)),v=xt(...a.map(A=>A.left)),b=a.filter(A=>h?A.left===v:A.right===g),R=b[0].top,P=b[b.length-1].bottom,O=v,_=g,x=_-O,E=P-R;return{top:R,bottom:P,left:O,right:_,width:x,height:E,x:O,y:R}}return u}const p=await r.getElementRects({reference:{getBoundingClientRect:w},floating:s.floating,strategy:l});return o.reference.x!==p.reference.x||o.reference.y!==p.reference.y||o.reference.width!==p.reference.width||o.reference.height!==p.reference.height?{reset:{rects:p}}:{}}}};function Ct(t){return t&&t.document&&t.location&&t.alert&&t.setInterval}function H(t){if(t==null)return window;if(!Ct(t)){const e=t.ownerDocument;return e&&e.defaultView||window}return t}function X(t){return H(t).getComputedStyle(t)}function V(t){return Ct(t)?"":t?(t.nodeName||"").toLowerCase():""}function $(t){return t instanceof H(t).HTMLElement}function F(t){return t instanceof H(t).Element}function It(t){return t instanceof H(t).Node}function lt(t){if(typeof ShadowRoot>"u")return!1;const e=H(t).ShadowRoot;return t instanceof e||t instanceof ShadowRoot}function K(t){const{overflow:e,overflowX:n,overflowY:i}=X(t);return/auto|scroll|overlay|hidden/.test(e+i+n)}function qt(t){return["table","td","th"].includes(V(t))}function Tt(t){const e=navigator.userAgent.toLowerCase().includes("firefox"),n=X(t);return n.transform!=="none"||n.perspective!=="none"||n.contain==="paint"||["transform","perspective"].includes(n.willChange)||e&&n.willChange==="filter"||e&&(n.filter?n.filter!=="none":!1)}function St(){return!/^((?!chrome|android).)*safari/i.test(navigator.userAgent)}var ut=Math.min,q=Math.max,G=Math.round;function N(t,e,n){var i,s,o,r;e===void 0&&(e=!1),n===void 0&&(n=!1);const l=t.getBoundingClientRect();let c=1,f=1;e&&$(t)&&(c=t.offsetWidth>0&&G(l.width)/t.offsetWidth||1,f=t.offsetHeight>0&&G(l.height)/t.offsetHeight||1);const d=F(t)?H(t):window,u=!St()&&n,a=(l.left+(u&&(i=(s=d.visualViewport)==null?void 0:s.offsetLeft)!=null?i:0))/c,m=(l.top+(u&&(o=(r=d.visualViewport)==null?void 0:r.offsetTop)!=null?o:0))/f,w=l.width/c,p=l.height/f;return{width:w,height:p,top:m,right:a+w,bottom:m+p,left:a,x:a,y:m}}function B(t){return((It(t)?t.ownerDocument:t.document)||window.document).documentElement}function Q(t){return F(t)?{scrollLeft:t.scrollLeft,scrollTop:t.scrollTop}:{scrollLeft:t.pageXOffset,scrollTop:t.pageYOffset}}function Lt(t){return N(B(t)).left+Q(t).scrollLeft}function Ut(t){const e=N(t);return G(e.width)!==t.offsetWidth||G(e.height)!==t.offsetHeight}function Xt(t,e,n){const i=$(e),s=B(e),o=N(t,i&&Ut(e),n==="fixed");let r={scrollLeft:0,scrollTop:0};const l={x:0,y:0};if(i||!i&&n!=="fixed")if((V(e)!=="body"||K(s))&&(r=Q(e)),$(e)){const c=N(e,!0);l.x=c.x+e.clientLeft,l.y=c.y+e.clientTop}else s&&(l.x=Lt(s));return{x:o.left+r.scrollLeft-l.x,y:o.top+r.scrollTop-l.y,width:o.width,height:o.height}}function kt(t){return V(t)==="html"?t:t.assignedSlot||t.parentNode||(lt(t)?t.host:null)||B(t)}function dt(t){return!$(t)||getComputedStyle(t).position==="fixed"?null:t.offsetParent}function Yt(t){let e=kt(t);for(lt(e)&&(e=e.host);$(e)&&!["html","body"].includes(V(e));){if(Tt(e))return e;e=e.parentNode}return null}function ot(t){const e=H(t);let n=dt(t);for(;n&&qt(n)&&getComputedStyle(n).position==="static";)n=dt(n);return n&&(V(n)==="html"||V(n)==="body"&&getComputedStyle(n).position==="static"&&!Tt(n))?e:n||Yt(t)||e}function ht(t){if($(t))return{width:t.offsetWidth,height:t.offsetHeight};const e=N(t);return{width:e.width,height:e.height}}function Gt(t){let{rect:e,offsetParent:n,strategy:i}=t;const s=$(n),o=B(n);if(n===o)return e;let r={scrollLeft:0,scrollTop:0};const l={x:0,y:0};if((s||!s&&i!=="fixed")&&((V(n)!=="body"||K(o))&&(r=Q(n)),$(n))){const c=N(n,!0);l.x=c.x+n.clientLeft,l.y=c.y+n.clientTop}return{...e,x:e.x-r.scrollLeft+l.x,y:e.y-r.scrollTop+l.y}}function Jt(t,e){const n=H(t),i=B(t),s=n.visualViewport;let o=i.clientWidth,r=i.clientHeight,l=0,c=0;if(s){o=s.width,r=s.height;const f=St();(f||!f&&e==="fixed")&&(l=s.offsetLeft,c=s.offsetTop)}return{width:o,height:r,x:l,y:c}}function Kt(t){var e;const n=B(t),i=Q(t),s=(e=t.ownerDocument)==null?void 0:e.body,o=q(n.scrollWidth,n.clientWidth,s?s.scrollWidth:0,s?s.clientWidth:0),r=q(n.scrollHeight,n.clientHeight,s?s.scrollHeight:0,s?s.clientHeight:0);let l=-i.scrollLeft+Lt(t);const c=-i.scrollTop;return X(s||n).direction==="rtl"&&(l+=q(n.clientWidth,s?s.clientWidth:0)-o),{width:o,height:r,x:l,y:c}}function Mt(t){const e=kt(t);return["html","body","#document"].includes(V(e))?t.ownerDocument.body:$(e)&&K(e)?e:Mt(e)}function J(t,e){var n;e===void 0&&(e=[]);const i=Mt(t),s=i===((n=t.ownerDocument)==null?void 0:n.body),o=H(i),r=s?[o].concat(o.visualViewport||[],K(i)?i:[]):i,l=e.concat(r);return s?l:l.concat(J(r))}function Qt(t,e){const n=e==null||e.getRootNode==null?void 0:e.getRootNode();if(t!=null&&t.contains(e))return!0;if(n&&lt(n)){let i=e;do{if(i&&t===i)return!0;i=i.parentNode||i.host}while(i)}return!1}function Zt(t,e){const n=N(t,!1,e==="fixed"),i=n.top+t.clientTop,s=n.left+t.clientLeft;return{top:i,left:s,x:s,y:i,right:s+t.clientWidth,bottom:i+t.clientHeight,width:t.clientWidth,height:t.clientHeight}}function gt(t,e,n){return e==="viewport"?U(Jt(t,n)):F(e)?Zt(e,n):U(Kt(B(t)))}function te(t){const e=J(t),i=["absolute","fixed"].includes(X(t).position)&&$(t)?ot(t):t;return F(i)?e.filter(s=>F(s)&&Qt(s,i)&&V(s)!=="body"):[]}function ee(t){let{element:e,boundary:n,rootBoundary:i,strategy:s}=t;const r=[...n==="clippingAncestors"?te(e):[].concat(n),i],l=r[0],c=r.reduce((f,d)=>{const u=gt(e,d,s);return f.top=q(u.top,f.top),f.right=ut(u.right,f.right),f.bottom=ut(u.bottom,f.bottom),f.left=q(u.left,f.left),f},gt(e,l,s));return{width:c.right-c.left,height:c.bottom-c.top,x:c.left,y:c.top}}var ne={getClippingRect:ee,convertOffsetParentRelativeRectToViewportRelativeRect:Gt,isElement:F,getDimensions:ht,getOffsetParent:ot,getDocumentElement:B,getElementRects:t=>{let{reference:e,floating:n,strategy:i}=t;return{reference:Xt(e,ot(n),i),floating:{...ht(n),x:0,y:0}}},getClientRects:t=>Array.from(t.getClientRects()),isRTL:t=>X(t).direction==="rtl"};function mt(t,e,n,i){i===void 0&&(i={});const{ancestorScroll:s=!0,ancestorResize:o=!0,elementResize:r=!0,animationFrame:l=!1}=i;let c=!1;const f=s&&!l,d=o&&!l,u=r&&!l,a=f||d?[...F(t)?J(t):[],...J(e)]:[];a.forEach(h=>{f&&h.addEventListener("scroll",n,{passive:!0}),d&&h.addEventListener("resize",n)});let m=null;u&&(m=new ResizeObserver(n),F(t)&&m.observe(t),m.observe(e));let w,p=l?N(t):null;l&&y();function y(){if(c)return;const h=N(t);p&&(h.x!==p.x||h.y!==p.y||h.width!==p.width||h.height!==p.height)&&n(),p=h,w=requestAnimationFrame(y)}return()=>{var h;c=!0,a.forEach(g=>{f&&g.removeEventListener("scroll",n),d&&g.removeEventListener("resize",n)}),(h=m)==null||h.disconnect(),m=null,l&&cancelAnimationFrame(w)}}var pt=(t,e,n)=>Vt(t,e,{platform:ne,...n}),oe=t=>{const e={placement:"bottom",middleware:[]},n=Object.keys(t),i=s=>t[s];return n.includes("offset")&&e.middleware.push(_t(i("offset"))),n.includes("placement")&&(e.placement=i("placement")),n.includes("autoPlacement")&&!n.includes("flip")&&e.middleware.push(st(i("autoPlacement"))),n.includes("flip")&&e.middleware.push(At(i("flip"))),n.includes("shift")&&e.middleware.push(Ot(i("shift"))),n.includes("inline")&&e.middleware.push(Pt(i("inline"))),n.includes("arrow")&&e.middleware.push(yt(i("arrow"))),n.includes("hide")&&e.middleware.push(Rt(i("hide"))),n.includes("size")&&e.middleware.push(Et(i("size"))),e},ie=(t,e)=>{const n={component:{trap:!1},float:{placement:"bottom",strategy:"absolute",middleware:[]}},i=s=>t[t.indexOf(s)+1];return t.includes("trap")&&(n.component.trap=!0),t.includes("teleport")&&(n.float.strategy="fixed"),t.includes("offset")&&n.float.middleware.push(_t(e.offset||10)),t.includes("placement")&&(n.float.placement=i("placement")),t.includes("autoPlacement")&&!t.includes("flip")&&n.float.middleware.push(st(e.autoPlacement)),t.includes("flip")&&n.float.middleware.push(At(e.flip)),t.includes("shift")&&n.float.middleware.push(Ot(e.shift)),t.includes("inline")&&n.float.middleware.push(Pt(e.inline)),t.includes("arrow")&&n.float.middleware.push(yt(e.arrow)),t.includes("hide")&&n.float.middleware.push(Rt(e.hide)),t.includes("size")&&n.float.middleware.push(Et(e.size)),n},re=t=>{var e="0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz".split(""),n="";t||(t=Math.floor(Math.random()*e.length));for(var i=0;i<t;i++)n+=e[Math.floor(Math.random()*e.length)];return n},se=[],le=[],ce=[];function ae(t,e){t._x_attributeCleanups&&Object.entries(t._x_attributeCleanups).forEach(([n,i])=>{(e===void 0||e.includes(n))&&(i.forEach(s=>s()),delete t._x_attributeCleanups[n])})}new MutationObserver(fe);function wt(t){return t()}function fe(t){let e=[],n=[],i=new Map,s=new Map;for(let o=0;o<t.length;o++)if(!t[o].target._x_ignoreMutationObserver&&(t[o].type==="childList"&&(t[o].addedNodes.forEach(r=>r.nodeType===1&&e.push(r)),t[o].removedNodes.forEach(r=>r.nodeType===1&&n.push(r))),t[o].type==="attributes")){let r=t[o].target,l=t[o].attributeName,c=t[o].oldValue,f=()=>{i.has(r)||i.set(r,[]),i.get(r).push({name:l,value:r.getAttribute(l)})},d=()=>{s.has(r)||s.set(r,[]),s.get(r).push(l)};r.hasAttribute(l)&&c===null?f():r.hasAttribute(l)?(d(),f()):d()}s.forEach((o,r)=>{ae(r,o)}),i.forEach((o,r)=>{se.forEach(l=>l(r,o))});for(let o of n)if(!e.includes(o)&&(le.forEach(r=>r(o)),o._x_cleanups))for(;o._x_cleanups.length;)o._x_cleanups.pop()();e.forEach(o=>{o._x_ignoreSelf=!0,o._x_ignore=!0});for(let o of e)n.includes(o)||o.isConnected&&(delete o._x_ignoreSelf,delete o._x_ignore,ce.forEach(r=>r(o)),o._x_ignore=!0,o._x_ignoreSelf=!0);e.forEach(o=>{delete o._x_ignoreSelf,delete o._x_ignore}),e=null,n=null,i=null,s=null}function ue(t,e=()=>{}){let n=!1;return function(){n?e.apply(this,arguments):(n=!0,t.apply(this,arguments))}}function de(t){const e={dismissable:!0,trap:!1};function n(o,r,l=null){if(r){if(r.hasAttribute("aria-expanded")||r.setAttribute("aria-expanded",!1),l.hasAttribute("id"))r.setAttribute("aria-controls",l.getAttribute("id"));else{const c=`panel-${re(8)}`;r.setAttribute("aria-controls",c),l.setAttribute("id",c)}l.setAttribute("aria-modal",!0),l.setAttribute("role","dialog")}}const i=document.querySelectorAll('[\\@click^="$float"]'),s=document.querySelectorAll('[x-on\\:click^="$float"]');[...i,...s].forEach(o=>{const r=o.parentElement.closest("[x-data]"),l=r.querySelector('[x-ref="panel"]');n(r,o,l)}),t.magic("float",o=>(r={},l={})=>{const c={...e,...l},f=Object.keys(r).length>0?oe(r):{middleware:[st()]},d=o,u=o.parentElement.closest("[x-data]"),a=u.querySelector('[x-ref="panel"]');function m(){return a.style.display=="block"}function w(){a.style.display="",d.setAttribute("aria-expanded",!1),c.trap&&a.setAttribute("x-trap",!1),mt(o,a,h)}function p(){a.style.display="block",d.setAttribute("aria-expanded",!0),c.trap&&a.setAttribute("x-trap",!0),h()}function y(){m()?w():p()}async function h(){return await pt(o,a,f).then(({middlewareData:g,placement:v,x:b,y:R})=>{var P,O;if(g.arrow){const _=(P=g.arrow)==null?void 0:P.x,x=(O=g.arrow)==null?void 0:O.y,E=f.middleware.filter(T=>T.name=="arrow")[0].options.element,A={top:"bottom",right:"left",bottom:"top",left:"right"}[v.split("-")[0]];Object.assign(E.style,{left:_!=null?`${_}px`:"",top:x!=null?`${x}px`:"",right:"",bottom:"",[A]:"-4px"})}if(g.hide){const{referenceHidden:_}=g.hide;Object.assign(a.style,{visibility:_?"hidden":"visible"})}Object.assign(a.style,{left:`${b}px`,top:`${R}px`})})}c.dismissable&&(window.addEventListener("click",g=>{!u.contains(g.target)&&m()&&y()}),window.addEventListener("keydown",g=>{g.key==="Escape"&&m()&&y()},!0)),y()}),t.directive("float",(o,{modifiers:r,expression:l},{evaluate:c,effect:f})=>{const d=l?c(l):{},u=r.length>0?ie(r,d):{};let a=null;u.float.strategy=="fixed"&&(o.style.position="fixed");const m=x=>o.parentElement&&!o.parentElement.closest("[x-data]").contains(x.target)?o.close():null,w=x=>x.key==="Escape"?o.close():null,p=o.getAttribute("x-ref"),y=o.parentElement.closest("[x-data]"),h=y.querySelectorAll(`[\\@click^="$refs.${p}"]`),g=y.querySelectorAll(`[x-on\\:click^="$refs.${p}"]`);o.style.setProperty("display","none"),n(y,[...h,...g][0],o),o._x_isShown=!1,o.trigger=null,o._x_doHide||(o._x_doHide=()=>{wt(()=>{o.style.setProperty("display","none",r.includes("important")?"important":void 0)})}),o._x_doShow||(o._x_doShow=()=>{wt(()=>{o.style.setProperty("display","block",r.includes("important")?"important":void 0)})});let v=()=>{o._x_doHide(),o._x_isShown=!1},b=()=>{o._x_doShow(),o._x_isShown=!0},R=()=>setTimeout(b),P=ue(x=>x?b():v(),x=>{typeof o._x_toggleAndCascadeWithTransitions=="function"?o._x_toggleAndCascadeWithTransitions(o,x,b,v):x?R():v()}),O,_=!0;f(()=>c(x=>{!_&&x===O||(r.includes("immediate")&&(x?R():v()),P(x),O=x,_=!1)})),o.open=async function(x){o.trigger=x.currentTarget?x.currentTarget:x,P(!0),o.trigger.setAttribute("aria-expanded",!0),u.component.trap&&o.setAttribute("x-trap",!0),a=mt(o.trigger,o,()=>{pt(o.trigger,o,u.float).then(({middlewareData:E,placement:A,x:T,y:S})=>{var C,L;if(E.arrow){const k=(C=E.arrow)==null?void 0:C.x,I=(L=E.arrow)==null?void 0:L.y,Z=u.float.middleware.filter($t=>$t.name=="arrow")[0].options.element,tt={top:"bottom",right:"left",bottom:"top",left:"right"}[A.split("-")[0]];Object.assign(Z.style,{left:k!=null?`${k}px`:"",top:I!=null?`${I}px`:"",right:"",bottom:"",[tt]:"-4px"})}if(E.hide){const{referenceHidden:k}=E.hide;Object.assign(o.style,{visibility:k?"hidden":"visible"})}Object.assign(o.style,{left:`${T}px`,top:`${S}px`})})}),window.addEventListener("click",m),window.addEventListener("keydown",w,!0)},o.close=function(){P(!1),o.trigger.setAttribute("aria-expanded",!1),u.component.trap&&o.setAttribute("x-trap",!1),a(),window.removeEventListener("click",m),window.removeEventListener("keydown",w,!1)},o.toggle=function(x){o._x_isShown?o.close():o.open(x)}})}var we=de;function he(t){t.directive("intersect",(e,{value:n,expression:i,modifiers:s},{evaluateLater:o,cleanup:r})=>{let l=o(i),c={rootMargin:pe(s),threshold:ge(s)},f=new IntersectionObserver(d=>{d.forEach(u=>{u.isIntersecting!==(n==="leave")&&(l(),s.includes("once")&&f.disconnect())})},c);f.observe(e),r(()=>{f.disconnect()})})}function ge(t){if(t.includes("full"))return .99;if(t.includes("half"))return .5;if(!t.includes("threshold"))return 0;let e=t[t.indexOf("threshold")+1];return e==="100"?1:e==="0"?0:+`.${e}`}function me(t){let e=t.match(/^(-?[0-9]+)(px|%)?$/);return e?e[1]+(e[2]||"px"):void 0}function pe(t){const e="margin",n="0px 0px 0px 0px",i=t.indexOf(e);if(i===-1)return n;let s=[];for(let o=1;o<5;o++)s.push(me(t[i+o]||""));return s=s.filter(o=>o!==void 0),s.length?s.join(" ").trim():n}var xe=he;export{xe as a,we as m};