!function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a="function"==typeof require&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}for(var i="function"==typeof require&&require,o=0;o<r.length;o++)s(r[o]);return s}({1:[function(require,module,exports){"use strict";function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}function setup(base,manifest){if(!manifest||(0,_meta2["default"])("manifest")||(0,_link2["default"])("manifest")||(0,_create2["default"])("link",{rel:"manifest",href:base},[],document.head),manifest&&manifest.theme_color&&!(0,_meta2["default"])("theme-color")&&(0,_create2["default"])("meta",{name:"theme-color",content:manifest.theme_color},[],document.head),!document.body)return void(0,_ready2["default"])(setup.bind(null,base,manifest));manifest=manifest||{},manifest.favicon=(0,_meta2["default"])("favicon")||(0,_fullpath2["default"])(manifest.favicon,base)||"/favicon.ico",manifest.author=(0,_meta2["default"])("author")||manifest.author,manifest.root=(0,_meta2["default"])("root")||(0,_fullpath2["default"])(manifest.root||"/",base),(0,_attr2["default"])("a[target=_blank]:not([rel=noopener])",{rel:"noopener"}),(0,_hasClass2["default"])(_documentElement2["default"],"no-adorn")||((0,_toolbar2["default"])(manifest),(0,_sidebar2["default"])(manifest),(0,_footer2["default"])(manifest));var tracking=(0,_meta2["default"])("ga:tracking")||manifest["ga:tracking"];tracking&&(0,_googleanalytics2["default"])(tracking);var sw=(0,_meta2["default"])("sw")||(0,_meta2["default"])("serviceworker");sw?sw=(0,_fullpath2["default"])(sw):(sw=manifest.sw||manifest.serviceworker,sw&&(sw=(0,_fullpath2["default"])(sw,base)));var serviceWorker=navigator.serviceWorker;sw&&serviceWorker&&(serviceWorker.ready.then(function(){var fallover=manifest.fallover;fallover&&(console.log("Adorn: SW ready: Posting fallover"),fallover.forEach(function(item){var type="fallover",fallover=item.fallover,mode=item.mode;fallover=(0,_fullpath2["default"])(fallover,base),serviceWorker.controller.postMessage({type:type,fallover:fallover,mode:mode})}))}),serviceWorker.register(sw).then(function(reg){console.log("Adorn: SW registration successful with scope: ",reg.scope)})["catch"](function(err){console.log("Adorn: SW registration failed: ",err)}))}var _json=require("tricks/http/json"),_json2=_interopRequireDefault(_json),_fullpath=require("tricks/string/fullpath"),_fullpath2=_interopRequireDefault(_fullpath),_attr=require("tricks/dom/attr"),_attr2=_interopRequireDefault(_attr),_meta=require("tricks/dom/meta"),_meta2=_interopRequireDefault(_meta),_link=require("tricks/dom/link"),_link2=_interopRequireDefault(_link),_create=require("tricks/dom/create"),_create2=_interopRequireDefault(_create),_hasClass=require("tricks/dom/hasClass"),_hasClass2=_interopRequireDefault(_hasClass),_documentElement=require("tricks/dom/documentElement"),_documentElement2=_interopRequireDefault(_documentElement),_ready=require("tricks/events/ready"),_ready2=_interopRequireDefault(_ready);require("tricks/support/touch"),require("tricks/support/html5"),require("tricks/support/viewport");var _cordovaExternalLinks=require("tricks/helper/cordovaExternalLinks"),_cordovaExternalLinks2=_interopRequireDefault(_cordovaExternalLinks),_googleanalytics=require("tricks/services/googleanalytics"),_googleanalytics2=_interopRequireDefault(_googleanalytics),_helpers=require("./components/helpers"),_helpers2=_interopRequireDefault(_helpers),_footer=require("./components/footer"),_footer2=_interopRequireDefault(_footer),_sidebar=require("./components/sidebar"),_sidebar2=_interopRequireDefault(_sidebar),_toolbar=require("./components/toolbar"),_toolbar2=_interopRequireDefault(_toolbar);(0,_ready2["default"])(_helpers2["default"]);var manifest_path=(0,_meta2["default"])("manifest")||(0,_link2["default"])("manifest")||"/manifest.json";(0,_json2["default"])(manifest_path,setup.bind(null,manifest_path)),(0,_cordovaExternalLinks2["default"])()},{"./components/footer":4,"./components/helpers":5,"./components/sidebar":6,"./components/toolbar":8,"tricks/dom/attr":14,"tricks/dom/create":15,"tricks/dom/documentElement":17,"tricks/dom/hasClass":21,"tricks/dom/link":26,"tricks/dom/meta":28,"tricks/events/ready":40,"tricks/helper/cordovaExternalLinks":41,"tricks/http/json":11,"tricks/services/googleanalytics":45,"tricks/string/fullpath":46,"tricks/support/html5":54,"tricks/support/touch":56,"tricks/support/viewport":57}],2:[function(require,module,exports){"use strict";function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}function updateHashLocation(headings){if("complete"===document.readyState){var T=window.scrollY||window.pageYOffset,H=window.innerHeight,toolbar=document.querySelector(".adorn-toolbar"),tag=void 0,toolbar_height=toolbar&&toolbar.offsetHeight||50,hash=window.location.hash;if(hash){var anchor=document.querySelector(hash);if(anchor){var t=(0,_findPos2["default"])(anchor)[1];if(t>T&&T+H>t)return}}if((0,_until2["default"])(headings,function(anchor){var t=(0,_findPos2["default"])(anchor)[1]+toolbar_height;return t>T?!0:void(tag=anchor)}),tag){var ref=tag.getElementsByTagName("a")[0];ref&&(ref=ref.getAttribute("href").replace(/^#/,"")),"history"in window&&"replaceState"in window.history&&window.location.hash!=="#"+ref&&history.replaceState({},document.title,"#"+ref),(0,_onhashchange2["default"])()}}}Object.defineProperty(exports,"__esModule",{value:!0});var _each=require("tricks/dom/each"),_each2=_interopRequireDefault(_each),_until=require("tricks/dom/until"),_until2=_interopRequireDefault(_until),_addClass=require("tricks/dom/addClass"),_addClass2=_interopRequireDefault(_addClass),_on=require("tricks/events/on"),_on2=_interopRequireDefault(_on),_create=require("tricks/dom/create"),_create2=_interopRequireDefault(_create),_findPos=require("tricks/dom/findPos"),_findPos2=_interopRequireDefault(_findPos),_id=require("tricks/dom/id"),_id2=_interopRequireDefault(_id),_ready=require("tricks/events/ready"),_ready2=_interopRequireDefault(_ready),_onhashchange=require("tricks/window/onhashchange"),_onhashchange2=_interopRequireDefault(_onhashchange),_Defer=require("tricks/object/Defer"),_Defer2=_interopRequireDefault(_Defer),_sleep=require("tricks/time/sleep"),_sleep2=_interopRequireDefault(_sleep),defer=new _Defer2["default"];(0,_ready2["default"])(function(){var headings=(0,_each2["default"])("h1,h2");if(document.querySelector&&!(document.documentElement.className||"").match(/adorn-(nav|toc)-off/)){(0,_each2["default"])(headings,function(tag){var ref=(0,_id2["default"])(tag);tag.insertBefore((0,_create2["default"])("a",{name:ref,href:"#"+ref,"class":"adorn-anchor"}),tag.firstChild)});var hash=window.location.hash;if(hash&&hash.length>2){var selected=document.querySelector(window.location.hash);selected&&selected.scrollIntoView()}headings.length&&setTimeout(function(){(0,_addClass2["default"])(document.documentElement,"adorn-toc-on")}),defer.resolve(headings);var sleepId=(0,_sleep2["default"])();(0,_on2["default"])(window,"scroll",function(){(0,_sleep2["default"])(updateHashLocation.bind(null,headings),100,sleepId)})}}),exports["default"]=function(callback){defer.push(callback)}},{"tricks/dom/addClass":13,"tricks/dom/create":15,"tricks/dom/each":18,"tricks/dom/findPos":19,"tricks/dom/id":22,"tricks/dom/until":34,"tricks/events/on":39,"tricks/events/ready":40,"tricks/object/Defer":42,"tricks/time/sleep":58,"tricks/window/onhashchange":59}],3:[function(require,module,exports){"use strict";function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}function createContentSelect(headings){var toc=(0,_create2["default"])("div",{"class":"adorn-toc"}),select=(0,_create2["default"])("select",{"aria-label":"menu"},[],toc),options=[];(0,_on2["default"])(select,"change",function(){window.location.hash=select.options[select.selectedIndex].value});var _group=select;return(0,_each2["default"])(headings,function(tag){var depth=+tag.tagName.match(/[0-9]/)[0],text=tag.innerText||tag.textContent||tag.innerHTML,ref=(0,_id2["default"])(tag);1===depth&&(_group=(0,_create2["default"])("optgroup",{label:text},[],select)),(0,_create2["default"])("option",{value:ref},[text],_group),options.push(ref)}),(0,_onhashchange2["default"])(function(hash){select.selectedIndex=options.indexOf(hash)}),toc}Object.defineProperty(exports,"__esModule",{value:!0});var _each=require("tricks/dom/each"),_each2=_interopRequireDefault(_each),_on=require("tricks/events/on"),_on2=_interopRequireDefault(_on),_create=require("tricks/dom/create"),_create2=_interopRequireDefault(_create),_id=require("tricks/dom/id"),_id2=_interopRequireDefault(_id),_onhashchange=require("tricks/window/onhashchange"),_onhashchange2=_interopRequireDefault(_onhashchange),_content=require("./content"),_content2=_interopRequireDefault(_content);exports["default"]=function(parent){(0,_content2["default"])(function(content){if(!(content.lenth<2)){var toc=createContentSelect(content,parent);parent.appendChild(toc)}})}},{"./content":2,"tricks/dom/create":15,"tricks/dom/each":18,"tricks/dom/id":22,"tricks/events/on":39,"tricks/window/onhashchange":59}],4:[function(require,module,exports){"use strict";function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}Object.defineProperty(exports,"__esModule",{value:!0});var _ready=require("tricks/events/ready"),_ready2=_interopRequireDefault(_ready),_create=require("tricks/dom/create"),_create2=_interopRequireDefault(_create);exports["default"]=function(manifest){manifest.author&&(0,_ready2["default"])(function(){var author=manifest.author.split(/\s*, \s*/);if(author){var children=["Authored by "];author[1]?children.push((0,_create2["default"])("a",{href:author[1],rel:"author"},[author[0]])):children.push(author[0]),(0,_create2["default"])("footer",{},children,document.body)}})}},{"tricks/dom/create":15,"tricks/events/ready":40}],5:[function(require,module,exports){"use strict";function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}function tryitButton(pre,func){var btn=(0,_create2["default"])("button",{"class":"tryit"},["tryit"]);(0,_insertAfter2["default"])(btn,pre),(0,_on2["default"])(btn,"click",function(){if(func)func();else{if("function"==typeof tryit&&!tryit(pre.innerText))return;setTimeout(function(){return eval(pre.innerText)},100)}}),func||pre.setAttribute("contenteditable",!0)}Object.defineProperty(exports,"__esModule",{value:!0});var _each=require("tricks/dom/each"),_each2=_interopRequireDefault(_each),_on=require("tricks/events/on"),_on2=_interopRequireDefault(_on),_create=require("tricks/dom/create"),_create2=_interopRequireDefault(_create),_insertAfter=require("tricks/dom/insertAfter"),_insertAfter2=_interopRequireDefault(_insertAfter);exports["default"]=function(){(0,_each2["default"])("pre",function(pre){"tryit"!==pre.className&&"tryitoffline"!==pre.className||tryitButton(pre)}),(0,_each2["default"])("script",function(script){var func=script.getAttribute("data-tryit");func&&tryitButton(script,window[func]),script.getAttribute("src")&&(0,_on2["default"])(script,"click",function(){window.open(script.getAttribute("src"),"_blank")})}),(0,_each2["default"])("link",function(script){script.getAttribute("href")&&(0,_on2["default"])(script,"click",function(){window.open(script.getAttribute("href"),"_blank")})})}},{"tricks/dom/create":15,"tricks/dom/each":18,"tricks/dom/insertAfter":23,"tricks/events/on":39}],6:[function(require,module,exports){"use strict";function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}function getParentUL(ul,i,j){if(j>i)return(0,_create2["default"])("ul",{},[],ul);do ul=(0,_parent2["default"])(ul,"ul")||ul;while(ul&&i-- >j);return ul}Object.defineProperty(exports,"__esModule",{value:!0});var _each=require("tricks/dom/each"),_each2=_interopRequireDefault(_each),_addClass=require("tricks/dom/addClass"),_addClass2=_interopRequireDefault(_addClass),_create=require("tricks/dom/create"),_create2=_interopRequireDefault(_create),_prepend=require("tricks/dom/prepend"),_prepend2=_interopRequireDefault(_prepend),_parent=require("tricks/dom/parent"),_parent2=_interopRequireDefault(_parent),_removeClass=require("tricks/dom/removeClass"),_removeClass2=_interopRequireDefault(_removeClass),_onhashchange=require("tricks/window/onhashchange"),_onhashchange2=_interopRequireDefault(_onhashchange),_content=require("./content"),_content2=_interopRequireDefault(_content),_id=require("tricks/dom/id"),_id2=_interopRequireDefault(_id);exports["default"]=function(){(0,_content2["default"])(function(content){if(content.length<2)return void(0,_addClass2["default"])(document.documentElement,"adorn-sidebar-off");var aside=(0,_prepend2["default"])("aside",{"class":"adorn-sidebar"}),i=0,prev=aside,items={};(0,_each2["default"])(content,function(item){var j=+item.tagName.match(/[0-9]/)[0],ul=getParentUL(prev,i,j);i=j;var text=item.innerText||item.textContent||item.innerHTML,ref=(0,_id2["default"])(item);items[ref]=prev=(0,_create2["default"])("li",{},[(0,_create2["default"])("a",{href:"#"+ref},[text])],ul)}),(0,_onhashchange2["default"])(function(hash){var item=items[hash];item&&((0,_removeClass2["default"])(".adorn-sidebar .selected","selected"),(0,_addClass2["default"])(item,"selected"))})})}},{"./content":2,"tricks/dom/addClass":13,"tricks/dom/create":15,"tricks/dom/each":18,"tricks/dom/id":22,"tricks/dom/parent":29,"tricks/dom/prepend":31,"tricks/dom/removeClass":33,"tricks/window/onhashchange":59}],7:[function(require,module,exports){"use strict";function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}function github_btn(manifest){var content=[],paths=manifest.paths;if(manifest.github){var repo=manifest.github;if(!repo.match("/")&&paths.length&&(repo+="/"+paths[0].replace(/\/$/,"")),repo.match("/")){var repo_path="https://github.com/"+repo,repo_file=link("source")||(window.location.pathname||"").replace(/^\/?([^\/]+)/g,"").replace(/\/$/,"index.html").replace(/^\//,"");content.push((0,_create2["default"])("a",{href:(0,_fullpath2["default"])(repo_file,repo_path+"/blob/master/"),target:"_blank",rel:"noopener",id:"adorn-edit"},["Edit this page"]),(0,_create2["default"])("span"),(0,_create2["default"])("a",{href:""+repo_path,target:"_blank",rel:"noopener",title:"Stars",id:"adorn-github-button"},[(0,_create2["default"])("i",{"class":"adorn-icon-github"}),(0,_create2["default"])("span",{"class":"adorn-speeach-bubble"})])),(0,_jsonp2["default"])("https://api.github.com/repos/"+repo+"?callback=?",function(r){r&&r.data&&r.data.watchers&&(0,_each2["default"])(".adorn-github-button span.adorn-speeach-bubble",function(item){item.innerHTML=r.data.watchers||""})})}}return _fragment2["default"].apply(void 0,content)}function twitter_btn(manifest){var content=[],twitter_creator=manifest["twitter:creator"]||(0,_meta2["default"])("twitter:creator");if(twitter_creator){var btn=(0,_create2["default"])("a",{href:"https://twitter.com/share","class":"adorn-twitter-button",target:"_blank",rel:"noopener","data-via":twitter_creator.replace("@",""),title:"Tweet"},[(0,_create2["default"])("i",{"class":"adorn-icon-twitter"})]);return content.push(btn,(0,_create2["default"])("a",{href:"https://twitter.com/search?ref_src=twsrc%5Etfw&q="+encodeURIComponent(url),"class":"adorn-twitter-count",rel:"noopener",target:"_blank"},[(0,_create2["default"])("i",{"class":"adorn-speeach-bubble"})])),(0,_jsonp2["default"])("https://cdn.syndication.twitter.com/widgets/tweetbutton/count.json?url="+encodeURIComponent(url),function(r){r&&(0,_each2["default"])(".adorn-twitter-count span.adorn-speeach-bubble",function(item){item.innerHTML=r.count||"",item.title="This page has been shared "+r.count+" times, view these tweets"})}),(0,_on2["default"])(btn,"click",function(e){e.preventDefault();var options={width:550,height:250},params={text:document.title,via:twitter_creator.replace("@",""),url:window.location.href.replace(/#.*/,"")},hashtag=(0,_meta2["default"])("twitter:hashtag")||manifest["twitter:hashtag"];hashtag&&(params.hashtag=hashtag),(0,_popup2["default"])("https://twitter.com/intent/tweet?"+(0,_querystringify2["default"])(params),"twitter",options)}),_fragment2["default"].apply(void 0,content)}}Object.defineProperty(exports,"__esModule",{value:!0}),exports.github_btn=github_btn,exports.twitter_btn=twitter_btn;var _each=require("tricks/dom/each"),_each2=_interopRequireDefault(_each),_jsonp=require("tricks/http/jsonp"),_jsonp2=_interopRequireDefault(_jsonp),_on=require("tricks/events/on"),_on2=_interopRequireDefault(_on),_create=require("tricks/dom/create"),_create2=_interopRequireDefault(_create),_fragment=require("tricks/dom/fragment"),_fragment2=_interopRequireDefault(_fragment),_querystringify=require("tricks/string/querystringify"),_querystringify2=_interopRequireDefault(_querystringify),_meta=require("tricks/dom/meta"),_meta2=_interopRequireDefault(_meta),_query=require("tricks/dom/query"),_query2=_interopRequireDefault(_query),_popup=require("tricks/window/popup"),_popup2=_interopRequireDefault(_popup),_fullpath=require("tricks/string/fullpath"),_fullpath2=_interopRequireDefault(_fullpath),link=function(){var a=(0,_query2["default"])("link[rel=source]");return a?a.getAttribute("href"):void 0},url=window.location.href},{"tricks/dom/create":15,"tricks/dom/each":18,"tricks/dom/fragment":20,"tricks/dom/meta":28,"tricks/dom/query":32,"tricks/events/on":39,"tricks/http/jsonp":12,"tricks/string/fullpath":46,"tricks/string/querystringify":50,"tricks/window/popup":60}],8:[function(require,module,exports){"use strict";function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}Object.defineProperty(exports,"__esModule",{value:!0});var _create=require("tricks/dom/create"),_create2=_interopRequireDefault(_create),_url=require("tricks/window/url"),_url2=_interopRequireDefault(_url),_ltrim=require("tricks/string/ltrim"),_ltrim2=_interopRequireDefault(_ltrim),_insertBefore=require("tricks/dom/insertBefore"),_insertBefore2=_interopRequireDefault(_insertBefore),_contentSelect=require("./contentSelect"),_contentSelect2=_interopRequireDefault(_contentSelect),_social=require("./social");exports["default"]=function(manifest){var path=window.location.pathname||"",root_path=(0,_url2["default"])(manifest.root).pathname;path=(0,_ltrim2["default"])(path,root_path),path=path.replace(/^\//g,"");var paths=path.split(/([^\/]+\/?)/).filter(function(s){return!!s});manifest.paths=paths;var crumbs=[(0,_create2["default"])("a",{href:manifest.root},[(0,_create2["default"])("img",{src:manifest.favicon,alt:window.location.hostname,title:manifest.name})])];paths.forEach(function(val,index){var href=manifest.root+paths.slice(0,index+1).join(""),text=val.replace(/\.(html?)$/,"");crumbs.push(" ",(0,_create2["default"])("a",{href:href},[text]))});var breadcrumbs=(0,_create2["default"])("div",{"class":"adorn-breadcrumbs"},crumbs),social_btns=(0,_create2["default"])("div",{"class":"adorn-links"},[(0,_social.github_btn)(manifest),(0,_create2["default"])("span"),(0,_social.twitter_btn)(manifest)]),aside=(0,_create2["default"])("aside",{"class":"adorn-toolbar"},[breadcrumbs,social_btns]);(0,_insertBefore2["default"])(aside,document.body.firstElementChild||document.body.firstChild),(0,_contentSelect2["default"])(breadcrumbs)}},{"./contentSelect":3,"./social":7,"tricks/dom/create":15,"tricks/dom/insertBefore":24,"tricks/string/ltrim":48,"tricks/window/url":61}],9:[function(require,module,exports){"use strict";module.exports=function(obj){return Array.prototype.slice.call(obj)}},{}],10:[function(require,module,exports){"use strict";var createElement=require("../../dom/createElement.js"),createEvent=require("../../events/createEvent.js");module.exports=function(url,callback){var timeout=arguments.length<=2||void 0===arguments[2]?0:arguments[2],bool=0,timer=void 0,head=document.getElementsByTagName("script")[0].parentNode,cb=function(e){!bool++&&callback&&callback(e),timer&&clearTimeout(timer)};timeout&&(timer=window.setTimeout(function(){cb(createEvent("timeout"))},timeout));var script=createElement("script",{src:url,onerror:cb,onload:cb,onreadystatechange:function(){/loaded|complete/i.test(script.readyState)&&cb(createEvent("load"))}});return script.async=!0,head.insertBefore(script,head.firstChild),script}},{"../../dom/createElement.js":16,"../../events/createEvent.js":35}],11:[function(require,module,exports){"use strict";var _typeof2="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(obj){return typeof obj}:function(obj){return obj&&"function"==typeof Symbol&&obj.constructor===Symbol&&obj!==Symbol.prototype?"symbol":typeof obj},_typeof="function"==typeof Symbol&&"symbol"===_typeof2(Symbol.iterator)?function(obj){return"undefined"==typeof obj?"undefined":_typeof2(obj)}:function(obj){return obj&&"function"==typeof Symbol&&obj.constructor===Symbol&&obj!==Symbol.prototype?"symbol":"undefined"==typeof obj?"undefined":_typeof2(obj)},jsonParse=require("../../string/jsonParse.js"),tryCatch=require("../../object/tryCatch.js");module.exports=function(url,callback){var x=new XMLHttpRequest;x.onload=function(){var v="object"===_typeof(x.response)?x.response:jsonParse(x.response);callback(v)},x.onerror=callback,x.open("GET",url),"responseType"in x&&tryCatch(function(){return x.responseType="json"}),x.send()}},{"../../object/tryCatch.js":44,"../../string/jsonParse.js":47}],12:[function(require,module,exports){"use strict";var globalCallback=require("../../events/globalCallback.js"),getScript=require("./getScript.js"),MATCH_CALLBACK_PLACEHOLDER=/=\?(&|$)/;module.exports=function(url,callback,callback_name){var timeout=arguments.length<=3||void 0===arguments[3]?6e4:arguments[3],result=void 0;callback_name=globalCallback(function(json){return result=json,!0},callback_name),url=url.replace(MATCH_CALLBACK_PLACEHOLDER,"="+callback_name+"$1");var script=getScript(url,function(){callback(result),script.parentNode.removeChild(script)},timeout);return script}},{"../../events/globalCallback.js":37,"./getScript.js":10}],13:[function(require,module,exports){"use strict";var each=require("./each.js"),hasClass=require("./hasClass.js");module.exports=function(elements,className){return each(elements,function(el){hasClass(el,className)||(el.className+=" "+className)})}},{"./each.js":18,"./hasClass.js":21}],14:[function(require,module,exports){"use strict";var each=require("./each.js");module.exports=function(elements,props){return each(elements,function(element){for(var x in props){var prop=props[x];"function"==typeof prop?element[x]=prop:element.setAttribute(x,prop)}})}},{"./each.js":18}],15:[function(require,module,exports){"use strict";var _typeof2="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(obj){return typeof obj}:function(obj){return obj&&"function"==typeof Symbol&&obj.constructor===Symbol&&obj!==Symbol.prototype?"symbol":typeof obj},_typeof="function"==typeof Symbol&&"symbol"===_typeof2(Symbol.iterator)?function(obj){return"undefined"==typeof obj?"undefined":_typeof2(obj)}:function(obj){return obj&&"function"==typeof Symbol&&obj.constructor===Symbol&&obj!==Symbol.prototype?"symbol":"undefined"==typeof obj?"undefined":_typeof2(obj)};module.exports=function(node){var attr=arguments.length<=1||void 0===arguments[1]?{}:arguments[1],children=arguments.length<=2||void 0===arguments[2]?[]:arguments[2],append=arguments.length<=3||void 0===arguments[3]?null:arguments[3],n="string"==typeof node?document.createElement(node):node;for(var x in attr)if(attr.hasOwnProperty(x))if("text"===x)n.appendChild(document.createTextNode(attr[x]));else if("html"===x)"string"==typeof attr[x]?n.innerHTML=attr[x]:n.appendChild(attr[x]);else if("object"===_typeof(attr[x]))for(var y in attr[x])attr[x].hasOwnProperty(y)&&(n[x][y]=attr[x][y]);else n.setAttribute(x,attr[x]);return children.forEach(function(child){"string"==typeof child&&(child=document.createTextNode(child)),child&&n.appendChild(child)}),append&&append.appendChild(n),n}},{}],16:[function(require,module,exports){"use strict";var attr=require("./attr.js");module.exports=function(tagName,attrs){var elm=document.createElement(tagName);return attr(elm,attrs),elm}},{"./attr.js":14}],17:[function(require,module,exports){"use strict";module.exports=document.documentElement||document.body.parentNode},{}],18:[function(require,module,exports){"use strict";var isDom=require("./isDom.js"),instanceOf=require("../object/instanceOf.js"),toArray=require("../array/toArray.js");module.exports=function(matches){var callback=arguments.length<=1||void 0===arguments[1]?function(){}:arguments[1];return isDom(matches)?matches=[matches]:"string"==typeof matches&&(matches=document.querySelectorAll(matches)),instanceOf(matches,Array)||(matches=toArray(matches)),callback&&matches.forEach(callback),matches}},{"../array/toArray.js":9,"../object/instanceOf.js":43,"./isDom.js":25}],19:[function(require,module,exports){"use strict";module.exports=function(obj){var curleft=0,curtop=0;if(obj.offsetParent)do curleft+=obj.offsetLeft,curtop+=obj.offsetTop;while(obj=obj.offsetParent);return[curleft,curtop]}},{}],20:[function(require,module,exports){"use strict";module.exports=function(){for(var _len=arguments.length,args=Array(_len),_key=0;_len>_key;_key++)args[_key]=arguments[_key];var frag=document.createDocumentFragment();return args.forEach(function(el){return frag.appendChild(el)}),frag}},{}],21:[function(require,module,exports){"use strict";var until=require("./until.js");module.exports=function(elements,className){var reg=new RegExp("(^|\\s)"+className+"($|\\s)","i");return until(elements,function(el){return(el.className||"").match(reg)})}},{"./until.js":34}],22:[function(require,module,exports){"use strict";module.exports=function(tag){if(tag.id)return tag.id;var text=tag.innerText||tag.textContent||tag.innerHTML,ref=text.toLowerCase().replace(/\s/g,"-").replace(/[^a-z0-9\_\-]/g,"");return tag.id=ref,ref}},{}],23:[function(require,module,exports){"use strict";module.exports=function(el,ref){ref.nextSibling?ref.parentNode.insertBefore(el,ref.nextSibling):ref.parentNode.appendChild(el)}},{}],24:[function(require,module,exports){"use strict";module.exports=function(el,ref){return ref.parentNode.insertBefore(el,ref)}},{}],25:[function(require,module,exports){"use strict";var instanceOf=require("../object/instanceOf.js"),_HTMLElement="undefined"!=typeof HTMLElement?HTMLElement:Element,_HTMLDocument="undefined"!=typeof HTMLDocument?HTMLDocument:Document,_Window=window.constructor;module.exports=function(test){return instanceOf(test,_HTMLElement)||instanceOf(test,_HTMLDocument)||instanceOf(test,_Window)}},{"../object/instanceOf.js":43}],26:[function(require,module,exports){"use strict";var tryCatch=require("../object/tryCatch.js"),query=require("./query.js");module.exports=function(name){return tryCatch(function(){return query('link[rel="'+name+'"]').href})}},{"../object/tryCatch.js":44,"./query.js":32}],27:[function(require,module,exports){"use strict";var until=require("./until.js"),el=document.createElement("div"),matches=el.matches||el.mozMatchesSelector||el.webkitMatchesSelector||el.msMatchesSelector||el.oMatchesSelector;module.exports=function(elements,query){var handler=query;return"string"==typeof query&&(handler=function(el){return matches.call(el,query)}),until(elements,handler)}},{"./until.js":34}],28:[function(require,module,exports){"use strict";var tryCatch=require("../object/tryCatch.js"),query=require("./query.js");module.exports=function(name){return tryCatch(function(){return query('meta[name="'+name+'"]').content})}},{"../object/tryCatch.js":44,"./query.js":32}],29:[function(require,module,exports){"use strict";var parents=require("./parents.js");module.exports=function(elements,match){var ul=parents(elements,match);return ul.length?ul[0]:null}},{"./parents.js":30}],30:[function(require,module,exports){"use strict";var each=require("./each.js"),matches=require("./matches.js"),documentElement=require("./documentElement.js");module.exports=function(elements,match){var m=[];return each(elements,function(el){for(;el&&el.parentNode&&(el=el.parentNode,el===document&&(el=documentElement),matches(el,match)&&m.push(el),el!==documentElement););}),m}},{"./documentElement.js":17,"./each.js":18,"./matches.js":27}],31:[function(require,module,exports){"use strict";var createElement=require("./createElement.js");module.exports=function(tagName,prop){var parent=arguments.length<=2||void 0===arguments[2]?document.body:arguments[2],elm=createElement(tagName,prop);return parent.insertBefore(elm,parent.firstChild),elm}},{"./createElement.js":16}],32:[function(require,module,exports){"use strict";module.exports=function(query){var parent=arguments.length<=1||void 0===arguments[1]?document:arguments[1];return parent.querySelector(query)}},{}],33:[function(require,module,exports){"use strict";var each=require("./each.js");module.exports=function(elements,className){var reg=new RegExp("(^|\\s)"+className+"($|\\s)","ig");return each(elements,function(el){el.className=el.className.replace(reg," ")})}},{"./each.js":18}],34:[function(require,module,exports){"use strict";var each=require("./each.js");module.exports=function(elements,callback){var bool=void 0;return each(elements,function(el){bool||(bool=callback(el))}),bool}},{"./each.js":18}],35:[function(require,module,exports){"use strict";var dict={bubbles:!0,cancelable:!0},createEvent=function(eventname){var options=arguments.length<=1||void 0===arguments[1]?dict:arguments[1];return new Event(eventname,options)};try{createEvent("test")}catch(e){createEvent=function(eventname){var options=arguments.length<=1||void 0===arguments[1]?dict:arguments[1],e=document.createEvent("Event");return e.initEvent(eventname,!!options.bubbles,!!options.cancelable),e}}module.exports=createEvent},{}],36:[function(require,module,exports){"use strict";var on=require("./on.js"),off=require("./off.js"),matches=require("../dom/matches.js");module.exports=function(match,eventName,handler){var root=arguments.length<=3||void 0===arguments[3]?document:arguments[3],eventHandler=function(e){for(var target=e.target;target;){if(matches(target,match)){e.delegateTarget=target,handler(e);break}target=target.parentNode}};return on(root,eventName,eventHandler),{remove:function(){return off(root,eventName,eventHandler)}}}},{"../dom/matches.js":27,"./off.js":38,"./on.js":39}],37:[function(require,module,exports){"use strict";function handle(guid,callback){for(var _len=arguments.length,args=Array(_len>2?_len-2:0),_key=2;_len>_key;_key++)args[_key-2]=arguments[_key];callback.apply(void 0,args)&&delete window[guid]}var random=require("../string/random.js");module.exports=function(callback,guid){var prefix=arguments.length<=2||void 0===arguments[2]?"_tricks_":arguments[2];return guid=guid||prefix+random(),window[guid]=handle.bind(null,guid,callback),guid}},{"../string/random.js":51}],38:[function(require,module,exports){"use strict";var each=require("../dom/each.js"),SEPERATOR=/[\s\,]+/;module.exports=function(elements,eventnames,callback){return eventnames=eventnames.split(SEPERATOR),each(elements,function(el){return eventnames.forEach(function(eventname){return el.removeEventListener(eventname,callback)})})}},{"../dom/each.js":18}],39:[function(require,module,exports){"use strict";var each=require("../dom/each.js"),SEPERATOR=/[\s\,]+/;module.exports=function(elements,eventnames,callback){var useCapture=arguments.length<=3||void 0===arguments[3]?!1:arguments[3];return eventnames=eventnames.split(SEPERATOR),each(elements,function(el){return eventnames.forEach(function(eventname){return el.addEventListener(eventname,callback,useCapture)})})}},{"../dom/each.js":18}],40:[function(require,module,exports){"use strict";var on=require("./on.js");module.exports=function(callback){
"loading"!==document.readyState&&document.body?callback():on(document,"DOMContentLoaded",callback)}},{"./on.js":39}],41:[function(require,module,exports){"use strict";var delegate=require("../events/delegate"),cordova=require("../support/cordova");module.exports=function(){var root=arguments.length<=0||void 0===arguments[0]?document:arguments[0];return cordova?void delegate("a","click",function(e){var target=e.delegateTarget;target.href&&target.href.match(/^https?:\/\//)&&(e.preventDefault(),window.open(target.href,"_system"))},root):!1}},{"../events/delegate":36,"../support/cordova":53}],42:[function(require,module,exports){"use strict";function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor))throw new TypeError("Cannot call a class as a function")}var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||!1,descriptor.configurable=!0,"value"in descriptor&&(descriptor.writable=!0),Object.defineProperty(target,descriptor.key,descriptor)}}return function(Constructor,protoProps,staticProps){return protoProps&&defineProperties(Constructor.prototype,protoProps),staticProps&&defineProperties(Constructor,staticProps),Constructor}}();module.exports=function(){function Defer(){_classCallCheck(this,Defer),this.items=[],this.state="pending",this.response=null,this.push.apply(this,arguments)}return _createClass(Defer,[{key:"push",value:function(){var _items,_this=this;(_items=this.items).push.apply(_items,arguments),"pending"!==this.state&&(this.items.forEach(function(item){return item(_this.response)}),this.length=0)}},{key:"resolve",value:function(response){this.state="resolved",this.response=response,this.push()}},{key:"length",get:function(){return this.items.length},set:function(value){return this.items.length=value}}]),Defer}()},{}],43:[function(require,module,exports){"use strict";module.exports=function(test,root){return root&&test instanceof root}},{}],44:[function(require,module,exports){"use strict";module.exports=function(fn){try{return fn.call(null)}catch(e){}}},{}],45:[function(require,module,exports){"use strict";var getScript=require("../http/getScript.js");module.exports=function(tracking){window._gaq=window._gaq||[],_gaq.push(["_setAccount",tracking]),_gaq.push(["_trackPageview"]),getScript(("https:"===document.location.protocol?"https://ssl":"http://www")+".google-analytics.com/ga.js")}},{"../http/getScript.js":10}],46:[function(require,module,exports){"use strict";module.exports=function(path){var relative=arguments.length<=1||void 0===arguments[1]?"./":arguments[1];if(!path)return"";try{return new URL(path,new URL(relative,window.location)).href||path}catch(e){return path}}},{}],47:[function(require,module,exports){"use strict";var tryCatch=require("../object/tryCatch.js");module.exports=function(str){return tryCatch(function(){return JSON.parse(str)})}},{"../object/tryCatch.js":44}],48:[function(require,module,exports){"use strict";module.exports=function(str,trim){return trim&&0===str.indexOf(trim)?str.slice(trim.length):str}},{}],49:[function(require,module,exports){"use strict";module.exports=function(hash){var delimiter=arguments.length<=1||void 0===arguments[1]?"&":arguments[1],seperator=arguments.length<=2||void 0===arguments[2]?"=":arguments[2],formatFunction=arguments.length<=3||void 0===arguments[3]?function(o){return o}:arguments[3];return Object.keys(hash).map(function(name){var value=formatFunction(hash[name]);return name+(null!==value?seperator+value:"")}).join(delimiter)}},{}],50:[function(require,module,exports){"use strict";var param=require("./param.js"),fn=function(value){return"?"===value?"?":encodeURIComponent(value)};module.exports=function(o){var formatter=arguments.length<=1||void 0===arguments[1]?fn:arguments[1];return param(o,"&","=",formatter)}},{"./param.js":49}],51:[function(require,module,exports){"use strict";module.exports=function(){return parseInt(1e12*Math.random(),10).toString(36)}},{}],52:[function(require,module,exports){"use strict";module.exports=function(property,enabled){document.documentElement.className=document.documentElement.className+" "+(enabled?"":"no-")+property}},{}],53:[function(require,module,exports){"use strict";var mobile=require("./mobile.js"),filesystem=/^file:\/{3}[^\/]/i.test(window.location.href);module.exports=mobile&&filesystem},{"./mobile.js":55}],54:[function(require,module,exports){"use strict";"header,section,datalist,option,footer,nav,menu,aside,article,style,script".split(",").forEach(function(tag){return document.createElement(tag)})},{}],55:[function(require,module,exports){"use strict";var bool=/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);module.exports=bool},{}],56:[function(require,module,exports){"use strict";var CSSsupports=require("./CSSsupports.js"),result="ontouchstart"in window;CSSsupports("touch",result),module.exports=result},{"./CSSsupports.js":52}],57:[function(require,module,exports){"use strict";var insertBefore=require("../dom/insertBefore.js"),create=require("../dom/create.js");insertBefore(create("meta",{name:"viewport",content:"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"}),document.getElementsByTagName("script")[0])},{"../dom/create.js":15,"../dom/insertBefore.js":24}],58:[function(require,module,exports){"use strict";var i=1,hash={};module.exports=function(callback){var period=arguments.length<=1||void 0===arguments[1]?0:arguments[1],guid=arguments.length<=2||void 0===arguments[2]?i++:arguments[2];return guid&&hash[guid]&&(clearTimeout(hash[guid]),delete hash[guid]),callback&&(hash[guid]=setTimeout(function(){callback()},period)),guid}},{}],59:[function(require,module,exports){"use strict";function handler(){var hash=window.location.hash.substr(1);a.forEach(function(callback){callback.call(null,hash)})}var on=require("../events/on"),a=[];on(window,"hashchange",handler),module.exports=function(callback){callback?a.push(callback):handler()}},{"../events/on":39}],60:[function(require,module,exports){"use strict";function generatePosition(_ref){var _ref2=_slicedToArray(_ref,2),Position=_ref2[0],Dimension=_ref2[1],position=Position.toLowerCase(),dimension=Dimension.toLowerCase();if(this[dimension]&&!(position in this)){var dualScreenPos=void 0!==window["screen"+Position]?window["screen"+Position]:screen[position],d=screen[dimension]||window["inner"+Dimension]||documentElement["client"+Dimension];this[position]=parseInt((d-this[dimension])/2,10)+dualScreenPos}}var _slicedToArray=function(){function sliceIterator(arr,i){var _arr=[],_n=!0,_d=!1,_e=void 0;try{for(var _s,_i=arr[Symbol.iterator]();!(_n=(_s=_i.next()).done)&&(_arr.push(_s.value),!i||_arr.length!==i);_n=!0);}catch(err){_d=!0,_e=err}finally{try{!_n&&_i["return"]&&_i["return"]()}finally{if(_d)throw _e}}return _arr}return function(arr,i){if(Array.isArray(arr))return arr;if(Symbol.iterator in Object(arr))return sliceIterator(arr,i);throw new TypeError("Invalid attempt to destructure non-iterable instance")}}(),param=require("../string/param.js"),documentElement=document.documentElement,dimensions=[["Top","Height"],["Left","Width"]];module.exports=function(url,target){var options=arguments.length<=2||void 0===arguments[2]?{}:arguments[2];return dimensions.forEach(generatePosition.bind(options)),window.open(url,target,param(options,","))}},{"../string/param.js":49}],61:[function(require,module,exports){"use strict";module.exports=function(path){if(path){if(window.URL&&URL instanceof Function&&0!==URL.length)return new URL(path,window.location);var a=document.createElement("a");return a.href=path,a.cloneNode(!1)}return window.location}},{}]},{},[1]);
//# sourceMappingURL=adorn.js.map