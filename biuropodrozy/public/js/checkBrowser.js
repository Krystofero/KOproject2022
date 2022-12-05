function isIE() {
    const ua = window.navigator.userAgent;
    return ua.indexOf('MSIE ') > 0 || ua.indexOf('Trident/') > 0;
}

if (isIE())
    alert("Zalecamy używać innej przeglądarki ponieważ obecna nie wspiera wszystkich funkcjonalności strony.");