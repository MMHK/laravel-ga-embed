(function(w,d,s,g,js,fs){
    g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
    js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
    js.src='https://apis.google.com/js/platform.js';
    fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
}(window,document,'script'));


(function (document) {
    var $wrapper = document.querySelector("#ga_wrapper"),
        $token = $wrapper.getAttribute("data-token"),
        $view_id = $wrapper.getAttribute("data-view-id"),
        $css = $wrapper.getAttribute("data-css");

    var style = document.createElement('link');
    style.setAttribute('media', 'all');
    style.setAttribute('type', 'text/css');
    style.setAttribute('rel', 'stylesheet');
    style.setAttribute('href', $css);
    document.head.appendChild(style);

    gapi.analytics.ready(function () {

        gapi.analytics.auth.authorize({
            'serverAuth': {
                'access_token': $token
            }
        });

        var dataChart1 = new gapi.analytics.googleCharts.DataChart({
            query: {
                'ids': 'ga:' + $view_id, // <-- Replace with the ids value for your view.
                'start-date': '30daysAgo',
                'end-date': 'today',
                'metrics': 'ga:sessions,ga:users',
                'dimensions': 'ga:date'
            },
            chart: {
                'container': 'chart-1-container',
                'type': 'LINE',
                'options': {
                    'width': '80%'
                }
            }
        });

        var dataChart2 = new gapi.analytics.googleCharts.DataChart({
            query: {
                'ids': 'ga:' + $view_id, // <-- Replace with the ids value for your view.
                'start-date': '30daysAgo',
                'end-date': 'today',
                'metrics': 'ga:pageviews,ga:uniquePageviews,ga:timeOnPage,ga:bounces,ga:entrances,ga:exits',
                'sort': '-ga:pageviews',
                'dimensions': 'ga:pagePath',
                'max-results': 10
            },
            chart: {
                'container': 'chart-2-container',
                'type': 'PIE',
                'options': {
                    'width': '80%',
                    'pieHole': 0.4,
                }
            }
        });

        var dataChart3 = new gapi.analytics.googleCharts.DataChart({
            query: {
                'ids': 'ga:' + $view_id, // <-- Replace with the ids value for your view.
                'start-date': '30daysAgo',
                'end-date': 'today',
                'metrics': 'ga:uniquePageviews',
                'sort': '-ga:uniquePageviews',
                'dimensions': 'ga:deviceCategory',
                'max-results': 10
            },
            chart: {
                'container': 'chart-3-container',
                'type': 'PIE',
                'options': {
                    'width': '80%',
                    'pieHole': 0.4,
                }
            }
        });


        dataChart1.execute();
        dataChart2.execute();
        dataChart3.execute();

        window.addEventListener('resize', function() {

            dataChart1.execute();
            dataChart2.execute();
            dataChart3.execute();
        });
    });
})(document);