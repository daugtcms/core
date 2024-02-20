<style>
    ._form_hide { display:none; visibility:hidden; }
    ._form_show { display:block; visibility:visible; }
    #_form_1_._form-top { top:0; }
    #_form_1_._form-bottom { bottom:0; }
    #_form_1_._form-left { left:0; }
    #_form_1_._form-right { right:0; }
    #_form_1_ textarea { resize:none; }
    #_form_1_ ._submit { -webkit-appearance:none; cursor:pointer; font-family:arial, sans-serif; font-size:14px; text-align:center; background:#fff !important; border:0 !important; -moz-border-radius:6px !important; -webkit-border-radius:6px !important; border-radius:6px !important; color:#ec4899 !important; padding:11px !important; }
    #_form_1_ ._close-icon:before { position:relative; }
    #_form_1_ ._form-body { margin-bottom:30px; }
    #_form_1_ ._form-image-left { width:150px; float:left; }
    #_form_1_ ._form-content-right { margin-left:164px; }
    #_form_1_ ._form-branding { color:#fff; font-size:10px; clear:both; text-align:left; margin-top:30px; font-weight:100; }
    #_form_1_ .form-sr-only { position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0, 0, 0, 0); border:0; }
    #_form_1_ ._form-label,#_form_1_ ._form_element ._form-label { font-weight:bold; margin-bottom:5px; display:block; }
    #_form_1_._dark ._form-branding { color:#333; }
    #_form_1_ ._form_element { position:relative; margin-bottom:10px; font-size:0; max-width:100%; }
    #_form_1_ ._form_element * { font-size:14px; }
    #_form_1_ ._form_element._clear { clear:both; width:100%; float:none; }
    #_form_1_ ._form_element._clear:after { clear:left; }
    #_form_1_ ._form_element input[type="text"],#_form_1_ ._form_element input[type="date"],#_form_1_ ._form_element select,#_form_1_ ._form_element textarea:not(.g-recaptcha-response) { display:block; width:100%; -webkit-box-sizing:border-box; -moz-box-sizing:border-box; box-sizing:border-box; font-family:inherit; }
    #_form_1_ ._field-wrapper { position:relative; }
    #_form_1_ ._inline-style { float:left; }
    #_form_1_ ._inline-style input[type="text"] { width:150px; }
    #_form_1_ ._inline-style:not(._clear) + ._inline-style:not(._clear) { margin-left:20px; }
    #_form_1_ ._form_element img._form-image { max-width:100%; }
    #_form_1_ ._form_element ._form-fieldset { border:0; padding:0.01em 0 0 0; margin:0; min-width:0; }
    #_form_1_ ._clear-element { clear:left; }
    #_form_1_ ._full_width { width:100%; }
    #_form_1_ ._form_full_field { display:block; width:100%; margin-bottom:10px; }
    #_form_1_ input[type="text"]._has_error,#_form_1_ textarea._has_error { border:#f37c7b 1px solid; }
    #_form_1_ input[type="checkbox"]._has_error { outline:#f37c7b 1px solid; }
    #_form_1_ ._error { display:block; position:absolute; font-size:14px; z-index:10000001; }
    #_form_1_ ._error._above { padding-bottom:4px; bottom:39px; right:0; }
    #_form_1_ ._error._below { padding-top:4px; top:100%; right:0; }
    #_form_1_ ._error._above ._error-arrow { bottom:0; right:15px; border-left:5px solid transparent; border-right:5px solid transparent; border-top:5px solid #f37c7b; }
    #_form_1_ ._error._below ._error-arrow { top:0; right:15px; border-left:5px solid transparent; border-right:5px solid transparent; border-bottom:5px solid #f37c7b; }
    #_form_1_ ._error-inner { padding:8px 12px; background-color:#f37c7b; font-size:14px; font-family:arial, sans-serif; color:#fff; text-align:center; text-decoration:none; -webkit-border-radius:4px; -moz-border-radius:4px; border-radius:4px; }
    #_form_1_ ._error-inner._form_error { margin-bottom:5px; text-align:left; }
    #_form_1_ ._button-wrapper ._error-inner._form_error { position:static; }
    #_form_1_ ._error-inner._no_arrow { margin-bottom:10px; }
    #_form_1_ ._error-arrow { position:absolute; width:0; height:0; }
    #_form_1_ ._error-html { margin-bottom:10px; }
    .pika-single { z-index:10000001 !important; }
    #_form_1_ input[type="text"].datetime_date { width:69%; display:inline; }
    #_form_1_ select.datetime_time { width:29%; display:inline; height:32px; }
    #_form_1_ input[type="date"].datetime_date { width:69%; display:inline-flex; }
    #_form_1_ input[type="time"].datetime_time { width:29%; display:inline-flex; }
    @media all and (min-width:320px) and (max-width:667px) { ::-webkit-scrollbar { display:none; }
        #_form_1_ { margin:0; width:100%; min-width:100%; max-width:100%; box-sizing:border-box; }
        #_form_1_ * { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; box-sizing:border-box; font-size:1em; }
        #_form_1_ ._form-content { margin:0; width:100%; }
        #_form_1_ ._form-inner { display:block; min-width:100%; }
        #_form_1_ ._form-title,#_form_1_ ._inline-style { margin-top:0; margin-right:0; margin-left:0; }
        #_form_1_ ._form-title { font-size:1.2em; }
        #_form_1_ ._form_element { margin:0 0 20px; padding:0; width:100%; }
        #_form_1_ ._form-element,#_form_1_ ._inline-style,#_form_1_ input[type="text"],#_form_1_ label,#_form_1_ p,#_form_1_ textarea:not(.g-recaptcha-response) { float:none; display:block; width:100%; }
        #_form_1_ ._row._checkbox-radio label { display:inline; }
        #_form_1_ ._row,#_form_1_ p,#_form_1_ label { margin-bottom:0.7em; width:100%; }
        #_form_1_ ._row input[type="checkbox"],#_form_1_ ._row input[type="radio"] { margin:0 !important; vertical-align:middle !important; }
        #_form_1_ ._row input[type="checkbox"] + span label { display:inline; }
        #_form_1_ ._row span label { margin:0 !important; width:initial !important; vertical-align:middle !important; }
        #_form_1_ ._form-image { max-width:100%; height:auto !important; }
        #_form_1_ input[type="text"] { padding-left:10px; padding-right:10px; font-size:16px; line-height:1.3em; -webkit-appearance:none; }
        #_form_1_ input[type="radio"],#_form_1_ input[type="checkbox"] { display:inline-block; width:1.3em; height:1.3em; font-size:1em; margin:0 0.3em 0 0; vertical-align:baseline; }
        #_form_1_ ._inline-style { margin:20px 0 0 !important; }
    }
    #_form_1_._inline-form,#_form_1_._inline-form ._form-content,#_form_1_._inline-form input,#_form_1_._inline-form ._submit { font-family:"IBM Plex Sans", Helvetica, sans-serif; }
    #_form_1_ ._form-title { font-size:22px; line-height:22px; font-weight:600; margin-bottom:0; }
    #_form_1_:before,#_form_1_:after { content:" "; display:table; }
    #_form_1_:after { clear:both; }
    #_form_1_._inline-style { width:auto; display:inline-block; }
    #_form_1_._inline-style input[type="text"],#_form_1_._inline-style input[type="date"] { padding:10px 12px; }
    #_form_1_._inline-style button._inline-style { position:relative; top:27px; }
    #_form_1_._inline-style p { margin:0; }
    #_form_1_._inline-style ._button-wrapper { position:relative; margin:27px 12.5px 0 20px; }
    #_form_1_ ._form-thank-you { position:relative; left:0; right:0; text-align:center; font-size:18px; }
    @media all and (min-width:320px) and (max-width:667px) { #_form_1_._inline-form._inline-style ._inline-style._button-wrapper { margin-top:20px !important; margin-left:0 !important; }
    }
    #_form_1_ .iti.iti--allow-dropdown.iti--separate-dial-code { width:100%; }
    #_form_1_ .iti input { width:100%; height:32px; border:#979797 1px solid; border-radius:4px; }
    #_form_1_ .iti--separate-dial-code .iti__selected-flag { background-color:#fff; border-radius:4px; }
    #_form_1_ .iti--separate-dial-code .iti__selected-flag:hover { background-color:rgba(0, 0, 0, 0.05); }
    #_form_1_ .iti__country-list { border-radius:4px; margin-top:4px; min-width:460px; }
    #_form_1_ .iti__country-list--dropup { margin-bottom:4px; }
    #_form_1_ .phone-error-hidden { display:none; }
    #_form_1_ .phone-error { color:#e40e49; }
    #_form_1_ .phone-input-error { border:1px solid #e40e49 !important; }

</style>
<!--<form method="POST" action="/proc.php" id="_form_1_" class="_form _form_1 _inline-form  _dark" novalidate data-styles-version="4">
    <input type="hidden" name="u" value="1" />
    <input type="hidden" name="f" value="1" />
    <input type="hidden" name="s" />
    <input type="hidden" name="c" value="0" />
    <input type="hidden" name="m" value="0" />
    <input type="hidden" name="act" value="sub" />
    <input type="hidden" name="v" value="2" />
    <input type="hidden" name="or" value="43b3284d0656e9540bf35dfdd17c8b59" />
    <div class="_form-content">
        <div class="_form_element _x33609033 _full_width _clear" >
            <div class="_form-title">
                E-Mail-Neuigkeiten abonnieren
            </div>
        </div>
        <div class="_form_element _x40130955 _full_width _clear" >
            <div class="_html-code">
                <p>
                    Fügen Sie eine beschreibende Nachricht hinzu, die Ihrem Besucher sagt, wofür er sich anmeldet.
                </p>
            </div>
        </div>
        <div class="_form_element _x36832111 _full_width " >
            <label for="fullname" class="_form-label">
                Vollständiger Name
            </label>
            <div class="_field-wrapper">
                <input type="text" id="fullname" name="fullname" placeholder="Tippen Sie Ihren Namen ein." />
            </div>
        </div>
        <div class="_form_element _x03542163 _full_width " >
            <label for="email" class="_form-label">
                E-Mail*
            </label>
            <div class="_field-wrapper">
                <input type="text" id="email" name="email" placeholder="Tippen Sie Ihre E-Mail ein." required/>
            </div>
        </div>
        <div class="_button-wrapper _full_width">
            <button id="_form_1_submit" class="_submit" type="submit">
                Absenden
            </button>
        </div>
        <div class="_clear-element">
        </div>
    </div>
    <div class="_form-thank-you" style="display:none;">
    </div>
</form>-->

<div class="">
    <div class="container py-8">
        <div class="rounded-3xl bg-primary-600 py-10 px-6 sm:py-16 sm:px-12 lg:p-16 shadow-xl border-primary-400 border-4">
            <div class="lg:flex lg:items-center _form-content relative">
                <div class="lg:w-0 lg:flex-1">
                    <h2 class="text-3xl font-bold tracking-tight text-white">{{$title ?: 'Newsletter'}}</h2>
                    <p class="mt-4 max-w-3xl text-lg text-primary-100">{{$description ?: 'Quis cillum elit et officia labore dolore exercitation adipisicing amet labore exercitation elit mollit ea. Ad veniam Lorem deserunt ad amet esse proident excepteur enim dolore.'}}</p>
                </div>
                <div class="mt-12 sm:w-full sm:max-w-xl lg:mt-0 lg:ml-8 lg:flex-1">
                    <form method="POST" action="{{$url}}/proc.php" id="_form_1_" class="sm:flex items-start gap-x-2" novalidate>
                        <input type="hidden" name="u" value="1" />
                        <input type="hidden" name="f" value="1" />
                        <input type="hidden" name="s" />
                        <input type="hidden" name="c" value="0" />
                        <input type="hidden" name="m" value="0" />
                        <input type="hidden" name="act" value="sub" />
                        <input type="hidden" name="v" value="2" />
                        <input type="hidden" name="or" value="{{$key}}" />
                        <label for="name" class="sr-only">Vor- und Nachname</label>
                        <input id="name" name="name" type="text" autocomplete="name" required class="flex-grow-0 px-3 py-3 w-full rounded-md shadow-sm border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50" placeholder="Vor- und Nachname">
                        <label for="email" class="sr-only">E-Mail</label>
                        <input id="email" name="email" type="text" autocomplete="email" required class="flex-grow-0 px-3 py-3 mt-3 sm:mt-0 w-full rounded-md shadow-sm border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50" placeholder="E-Mail">
                        <button type="submit" id="_form_1_submit" class="mt-3 flex w-full items-center justify-center rounded-md border border-transparent bg-primary-700 px-5 py-3 text-base font-medium text-white hover:bg-primary-500 focus:outline-none sm:mt-0 sm:w-auto sm:flex-shrink-0">Anmelden</button>
                    </form>
                    <p class="mt-3 text-sm text-primary-100 mx-2">
                        Bei der Anmeldung stimmen Sie der <a href="/datenschutz" class="font-medium text-white underline">Datenschutzerklärung</a> zu.
                    </p>
                </div>
            </div>
            <div class="_form-thank-you text-lg text-primary-100" style="display:none;"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.cfields = [];
    window._show_thank_you = function(id, message, trackcmp_url, email) {
        var form = document.getElementById('_form_' + id + '_'), thank_you = document.querySelector('._form-thank-you');
        document.querySelector('._form-content').style.display = 'none';
        thank_you.innerHTML = message;
        thank_you.style.display = 'block';
        const vgoAlias = typeof visitorGlobalObjectAlias === 'undefined' ? 'vgo' : visitorGlobalObjectAlias;
        var visitorObject = window[vgoAlias];
        if (email && typeof visitorObject !== 'undefined') {
            visitorObject('setEmail', email);
            visitorObject('update');
        } else if (typeof(trackcmp_url) != 'undefined' && trackcmp_url) {
            // Site tracking URL to use after inline form submission.
            _load_script(trackcmp_url);
        }
        if (typeof window._form_callback !== 'undefined') window._form_callback(id);
    };
    window._show_error = function(id, message, html) {
        var form = document.getElementById('_form_' + id + '_'),
            err = document.createElement('div'),
            button = form.querySelector('button'),
            old_error = form.querySelector('._form_error');
        if (old_error) old_error.parentNode.removeChild(old_error);
        err.innerHTML = message;
        err.className = '_error-inner _form_error _no_arrow';
        var wrapper = document.createElement('div');
        wrapper.className = '_form-inner';
        wrapper.appendChild(err);
        button.parentNode.insertBefore(wrapper, button);
        var submitButton = form.querySelector('[id^="_form"][id$="_submit"]');
        submitButton.disabled = false;
        submitButton.classList.remove('processing');
        if (html) {
            var div = document.createElement('div');
            div.className = '_error-html';
            div.innerHTML = html;
            err.appendChild(div);
        }
    };
    window._load_script = function(url, callback, isSubmit) {
        var head = document.querySelector('head'), script = document.createElement('script'), r = false;
        var submitButton = document.querySelector('#_form_1_submit');
        script.type = 'text/javascript';
        script.charset = 'utf-8';
        script.src = url;
        if (callback) {
            script.onload = script.onreadystatechange = function() {
                if (!r && (!this.readyState || this.readyState == 'complete')) {
                    r = true;
                    callback();
                }
            };
        }
        script.onerror = function() {
            if (isSubmit) {
                if (script.src.length > 10000) {
                    _show_error("1", "Ihre Übermittlung konnte nicht gesendet werden. Bitte kürzen Sie Ihre Antworten und versuche es erneut.");
                } else {
                    _show_error("1", "Ihre Übermittlung konnte nicht gesendet werden. Bitte versuchen Sie es erneut.");
                }
                submitButton.disabled = false;
                submitButton.classList.remove('processing');
            }
        }

        head.appendChild(script);
    };
    (function() {
        if (window.location.search.search("excludeform") !== -1) return false;
        var getCookie = function(name) {
            var match = document.cookie.match(new RegExp('(^|; )' + name + '=([^;]+)'));
            return match ? match[2] : null;
        }
        var setCookie = function(name, value) {
            var now = new Date();
            var time = now.getTime();
            var expireTime = time + 1000 * 60 * 60 * 24 * 365;
            now.setTime(expireTime);
            document.cookie = name + '=' + value + '; expires=' + now + ';path=/; Secure; SameSite=Lax;';
        }
        var addEvent = function(element, event, func) {
            if (element.addEventListener) {
                element.addEventListener(event, func);
            } else {
                var oldFunc = element['on' + event];
                element['on' + event] = function() {
                    oldFunc.apply(this, arguments);
                    func.apply(this, arguments);
                };
            }
        }
        var _removed = false;
        var form_to_submit = document.getElementById('_form_1_');
        var allInputs = form_to_submit.querySelectorAll('input, select, textarea'), tooltips = [], submitted = false;

        var getUrlParam = function(name) {
            var params = new URLSearchParams(window.location.search);
            return params.get(name) || false;
        };

        var acctDateFormat = "%m/%d/%Y";
        var getNormalizedDate = function(date, acctFormat) {
            var decodedDate = decodeURIComponent(date);
            if (acctFormat && acctFormat.match(/(%d|%e).*%m/gi) !== null) {
                return decodedDate.replace(/(\d{2}).*(\d{2}).*(\d{4})/g, '$3-$2-$1');
            } else if (Date.parse(decodedDate)) {
                var dateObj = new Date(decodedDate);
                var year = dateObj.getFullYear();
                var month = dateObj.getMonth() + 1;
                var day = dateObj.getDate();
                return `${year}-${month < 10 ? `0${month}` : month}-${day < 10 ? `0${day}` : day}`;
            }
            return false;
        };

        var getNormalizedTime = function(time) {
            var hour, minutes;
            var decodedTime = decodeURIComponent(time);
            var timeParts = Array.from(decodedTime.matchAll(/(\d{1,2}):(\d{1,2})\W*([AaPp][Mm])?/gm))[0];
            if (timeParts[3]) { // 12 hour format
                var isPM = timeParts[3].toLowerCase() === 'pm';
                if (isPM) {
                    hour = parseInt(timeParts[1]) === 12 ? '12' : `${parseInt(timeParts[1]) + 12}`;
                } else {
                    hour = parseInt(timeParts[1]) === 12 ? '0' : timeParts[1];
                }
            } else { // 24 hour format
                hour = timeParts[1];
            }
            var normalizedHour = parseInt(hour) < 10 ? `0${parseInt(hour)}` : hour;
            var minutes = timeParts[2];
            return `${normalizedHour}:${minutes}`;
        };

        for (var i = 0; i < allInputs.length; i++) {
            var regexStr = "field\\[(\\d+)\\]";
            var results = new RegExp(regexStr).exec(allInputs[i].name);
            if (results != undefined) {
                allInputs[i].dataset.name = allInputs[i].name.match(/\[time\]$/)
                    ? `${window.cfields[results[1]]}_time`
                    : window.cfields[results[1]];
            } else {
                allInputs[i].dataset.name = allInputs[i].name;
            }
            var fieldVal = getUrlParam(allInputs[i].dataset.name);

            if (fieldVal) {
                if (allInputs[i].dataset.autofill === "false") {
                    continue;
                }
                if (allInputs[i].type == "radio" || allInputs[i].type == "checkbox") {
                    if (allInputs[i].value == fieldVal) {
                        allInputs[i].checked = true;
                    }
                } else if (allInputs[i].type == "date") {
                    allInputs[i].value = getNormalizedDate(fieldVal, acctDateFormat);
                } else if (allInputs[i].type == "time") {
                    allInputs[i].value = getNormalizedTime(fieldVal);
                } else {
                    allInputs[i].value = fieldVal;
                }
            }
        }

        var remove_tooltips = function() {
            for (var i = 0; i < tooltips.length; i++) {
                tooltips[i].tip.parentNode.removeChild(tooltips[i].tip);
            }
            tooltips = [];
        };
        var remove_tooltip = function(elem) {
            for (var i = 0; i < tooltips.length; i++) {
                if (tooltips[i].elem === elem) {
                    tooltips[i].tip.parentNode.removeChild(tooltips[i].tip);
                    tooltips.splice(i, 1);
                    return;
                }
            }
        };
        var create_tooltip = function(elem, text) {
            var tooltip = document.createElement('div'),
                arrow = document.createElement('div'),
                inner = document.createElement('div'), new_tooltip = {};
            if (elem.type != 'radio' && elem.type != 'checkbox') {
                tooltip.className = '_error';
                arrow.className = '_error-arrow';
                inner.className = '_error-inner';
                inner.innerHTML = text;
                tooltip.appendChild(arrow);
                tooltip.appendChild(inner);
                elem.parentNode.appendChild(tooltip);
            } else {
                tooltip.className = '_error-inner _no_arrow';
                tooltip.innerHTML = text;
                elem.parentNode.insertBefore(tooltip, elem);
                new_tooltip.no_arrow = true;
            }
            new_tooltip.tip = tooltip;
            new_tooltip.elem = elem;
            tooltips.push(new_tooltip);
            return new_tooltip;
        };
        var resize_tooltip = function(tooltip) {
            var rect = tooltip.elem.getBoundingClientRect();
            var doc = document.documentElement,
                scrollPosition = rect.top - ((window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0));
            if (scrollPosition < 40) {
                tooltip.tip.className = tooltip.tip.className.replace(/ ?(_above|_below) ?/g, '') + ' _below';
            } else {
                tooltip.tip.className = tooltip.tip.className.replace(/ ?(_above|_below) ?/g, '') + ' _above';
            }
        };
        var resize_tooltips = function() {
            if (_removed) return;
            for (var i = 0; i < tooltips.length; i++) {
                if (!tooltips[i].no_arrow) resize_tooltip(tooltips[i]);
            }
        };
        var validate_field = function(elem, remove) {
            var tooltip = null, value = elem.value, no_error = true;
            remove ? remove_tooltip(elem) : false;
            if (elem.type != 'checkbox') elem.className = elem.className.replace(/ ?_has_error ?/g, '');
            if (elem.getAttribute('required') !== null) {
                if (elem.type == 'radio' || (elem.type == 'checkbox' && /any/.test(elem.className))) {
                    var elems = form_to_submit.elements[elem.name];
                    if (!(elems instanceof NodeList || elems instanceof HTMLCollection) || elems.length <= 1) {
                        no_error = elem.checked;
                    }
                    else {
                        no_error = false;
                        for (var i = 0; i < elems.length; i++) {
                            if (elems[i].checked) no_error = true;
                        }
                    }
                    if (!no_error) {
                        tooltip = create_tooltip(elem, "Bitte eine Option auswählen.");
                    }
                } else if (elem.type =='checkbox') {
                    var elems = form_to_submit.elements[elem.name], found = false, err = [];
                    no_error = true;
                    for (var i = 0; i < elems.length; i++) {
                        if (elems[i].getAttribute('required') === null) continue;
                        if (!found && elems[i] !== elem) return true;
                        found = true;
                        elems[i].className = elems[i].className.replace(/ ?_has_error ?/g, '');
                        if (!elems[i].checked) {
                            no_error = false;
                            elems[i].className = elems[i].className + ' _has_error';
                            err.push("Die Markierung von %s ist erforderlich.".replace("%s", elems[i].value));
                        }
                    }
                    if (!no_error) {
                        tooltip = create_tooltip(elem, err.join('<br/>'));
                    }
                } else if (elem.tagName == 'SELECT') {
                    var selected = true;
                    if (elem.multiple) {
                        selected = false;
                        for (var i = 0; i < elem.options.length; i++) {
                            if (elem.options[i].selected) {
                                selected = true;
                                break;
                            }
                        }
                    } else {
                        for (var i = 0; i < elem.options.length; i++) {
                            if (elem.options[i].selected
                                && (!elem.options[i].value
                                    || (elem.options[i].value.match(/\n/g)))
                            ) {
                                selected = false;
                            }
                        }
                    }
                    if (!selected) {
                        elem.className = elem.className + ' _has_error';
                        no_error = false;
                        tooltip = create_tooltip(elem, "Bitte eine Option auswählen.");
                    }
                } else if (value === undefined || value === null || value === '') {
                    elem.className = elem.className + ' _has_error';
                    no_error = false;
                    tooltip = create_tooltip(elem, "Bitte füllen Sie das markierte Pflichtfeld aus.");
                }
            }
            if (no_error && (elem.id == 'field[]' || elem.id == 'ca[11][v]')) {
                if (elem.className.includes('phone-input-error')) {
                    elem.className = elem.className + ' _has_error';
                    no_error = false;
                }
            }
            if (no_error && elem.name == 'email') {
                if (!value.match(/^[\+_a-z0-9-'&=]+(\.[\+_a-z0-9-']+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i)) {
                    elem.className = elem.className + ' _has_error';
                    no_error = false;
                    tooltip = create_tooltip(elem, "Geben Sie eine gültige E-Mail-Adresse ein.");
                }
            }
            if (no_error && /date_field/.test(elem.className)) {
                if (!value.match(/^\d\d\d\d-\d\d-\d\d$/)) {
                    elem.className = elem.className + ' _has_error';
                    no_error = false;
                    tooltip = create_tooltip(elem, "Gültiges Datum eingeben");
                }
            }
            tooltip ? resize_tooltip(tooltip) : false;
            return no_error;
        };
        var needs_validate = function(el) {
            if(el.getAttribute('required') !== null){
                return true
            }
            if(el.name === 'email' && el.value !== ""){
                return true
            }

            if((el.id == 'field[]' || el.id == 'ca[11][v]') && el.className.includes('phone-input-error')){
                return true
            }

            return false
        };
        var validate_form = function(e) {
            var err = form_to_submit.querySelector('._form_error'), no_error = true;
            if (!submitted) {
                submitted = true;
                for (var i = 0, len = allInputs.length; i < len; i++) {
                    var input = allInputs[i];
                    if (needs_validate(input)) {
                        if (input.type == 'tel') {
                            addEvent(input, 'blur', function() {
                                this.value = this.value.trim();
                                validate_field(this, true);
                            });
                        }
                        if (input.type == 'text' || input.type == 'number' || input.type == 'time') {
                            addEvent(input, 'blur', function() {
                                this.value = this.value.trim();
                                validate_field(this, true);
                            });
                            addEvent(input, 'input', function() {
                                validate_field(this, true);
                            });
                        } else if (input.type == 'radio' || input.type == 'checkbox') {
                            (function(el) {
                                var radios = form_to_submit.elements[el.name];
                                for (var i = 0; i < radios.length; i++) {
                                    addEvent(radios[i], 'click', function() {
                                        validate_field(el, true);
                                    });
                                }
                            })(input);
                        } else if (input.tagName == 'SELECT') {
                            addEvent(input, 'change', function() {
                                validate_field(this, true);
                            });
                        } else if (input.type == 'textarea'){
                            addEvent(input, 'input', function() {
                                validate_field(this, true);
                            });
                        }
                    }
                }
            }
            remove_tooltips();
            for (var i = 0, len = allInputs.length; i < len; i++) {
                var elem = allInputs[i];
                if (needs_validate(elem)) {
                    if (elem.tagName.toLowerCase() !== "select") {
                        elem.value = elem.value.trim();
                    }
                    validate_field(elem) ? true : no_error = false;
                }
            }
            if (!no_error && e) {
                e.preventDefault();
            }
            resize_tooltips();
            return no_error;
        };
        addEvent(window, 'resize', resize_tooltips);
        addEvent(window, 'scroll', resize_tooltips);

        var hidePhoneInputError = function(inputId) {
            var errorMessage =  document.getElementById("error-msg-" + inputId);
            var input = document.getElementById(inputId);
            errorMessage.classList.remove("phone-error");
            errorMessage.classList.add("phone-error-hidden");
            input.classList.remove("phone-input-error");
        };

        var initializePhoneInput = function(input, defaultCountry) {
            return window.intlTelInput(input, {
                utilsScript: "https://unpkg.com/intl-tel-input@17.0.18/build/js/utils.js",
                autoHideDialCode: false,
                separateDialCode: true,
                initialCountry: defaultCountry,
                preferredCountries: []
            });
        }

        var setPhoneInputEventListeners = function(inputId, input, iti) {
            input.addEventListener('blur', function() {
                var errorMessage = document.getElementById("error-msg-" + inputId);
                if (input.value.trim()) {
                    if (iti.isValidNumber()) {
                        iti.setNumber(iti.getNumber());
                        if (errorMessage.classList.contains("phone-error")){
                            hidePhoneInputError(inputId);
                        }
                    } else {
                        showPhoneInputError(inputId)
                    }
                } else {
                    if (errorMessage.classList.contains("phone-error")){
                        hidePhoneInputError(inputId);
                    }
                }
            });

            input.addEventListener("countrychange", function() {
                iti.setNumber('');
            });

            input.addEventListener("keydown", function(e) {
                var charCode = (e.which) ? e.which : e.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 8) {
                    e.preventDefault();
                }
            });
        };

        var showPhoneInputError = function(inputId) {
            var errorMessage =  document.getElementById("error-msg-" + inputId);
            var input = document.getElementById(inputId);
            errorMessage.classList.add("phone-error");
            errorMessage.classList.remove("phone-error-hidden");
            input.classList.add("phone-input-error");
        };


        var _form_serialize = function(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=0;i<form.elements.length;i++){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"tel":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].previousSibling.querySelector('div.iti__selected-dial-code').innerText)+encodeURIComponent(" ")+encodeURIComponent(form.elements[i].value));break;case"text":case"number":case"date":case"time":case"hidden":case"password":case"button":case"reset":case"submit":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=0;j<form.elements[i].options.length;j++){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};

        const formSupportsPost = false;
        var form_submit = function(e) {
            e.preventDefault();
            if (validate_form()) {
                // use this trick to get the submit button & disable it using plain javascript
                var submitButton = e.target.querySelector('#_form_1_submit');
                submitButton.disabled = true;
                submitButton.classList.add('processing');
                var serialized = _form_serialize(
                    document.getElementById('_form_1_')
                ).replace(/%0A/g, '\\n');
                var err = form_to_submit.querySelector('._form_error');
                err ? err.parentNode.removeChild(err) : false;
                async function submitForm() {
                    var formData = new FormData();
                    const searchParams = new URLSearchParams(serialized);
                    searchParams.forEach((value, key) => {
                        formData.append(key, value);
                    });

                    const response = await fetch('{{$url}}/proc.php?jsonp=true', {
                        headers: {
                            "Accept": "application/json"
                        },
                        body: formData,
                        method: "POST"
                    });
                    return response.json();
                }

                if (formSupportsPost) {
                    submitForm().then((data) => {
                        eval(data.js);
                    });
                } else {
                    _load_script('{{$url}}/proc.php?' + serialized + '&jsonp=true', null, true);
                }
            }
            return false;
        };
        addEvent(form_to_submit, 'submit', form_submit);
    })();

</script>