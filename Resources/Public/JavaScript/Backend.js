(function() {
    var httpRequest;
    document.getElementsByClassName('t3js-yaml-export')[0].addEventListener('click', makeRequest);

    function makeRequest() {
        httpRequest = new XMLHttpRequest();

        if (!httpRequest) {
            alert('Giving up :( Cannot create an XMLHTTP instance');
            return false;
        }

        httpRequest.onreadystatechange = alertContents;
        httpRequest.open('GET', TYPO3.settings.ajaxUrls['yaml_export']);
        httpRequest.send();
    }

    function alertContents() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                var _response = JSON.parse(httpRequest.response);

                Notification(_response)
            } else {
                console.log("error");
            }
        }
    }

    function Notification(response) {
        require(['TYPO3/CMS/Backend/Notification'], function(Notification) {
            switch (response.status) {
                case 1:
                    Notification.warning(response.title, response.message);
                    break;
                case 255:
                    Notification.notice(response.title, response.message);
                    break;
                case 500:
                    Notification.error(response.title, response.message);
                    break;
                default:
                    Notification.success(response.title, response.message);
                    break;
            }
        });
    }
})();