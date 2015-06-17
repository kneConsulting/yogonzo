<?php
?>

<!DOCTYPE html>
<html>
<head>
  <title>Embed API Demo</title>
  <style type="text/css">
    .sessions {
      width: 100%;
      height: 300px;
    }

    .inner-sessions{
      margin: auto;
      display: block;
      /*width: 60%;*/
      height: 100%;
    }

    #timeline{
      margin: auto;
      float: left;
      padding-left: 30px;
    }

    #timeline2{
      margin: auto;
      float: left;
      padding-left: 50px;
    }

    #operating-sys{
      margin: auto;
      float: left;
      padding-left: 30px;
    }

    #browser{
      margin: auto;
      float: left;
      padding-left: 50px;
    }

    #avgSeshDuration{
      margin: auto;
      float: left;
      padding-left: 30px;
    }

    #bounce{
      margin: auto;
      float: left;
      padding-left: 50px;
    }


  </style>
</head>
<body>

<!-- Step 1: Create the containing elements. -->

<section id="auth-button"></section>
<section id="view-selector"></section>

<br>
<br>

<a href="index.php" id="return" style="text-decoration:none"><font color="gray" face="helvetica">Return to YoGonzo</font></a>

<br>
<br>

<section class="sessions">
  <div class="inner-sessions">
    <div id="timeline"></div>
    <div id="timeline2"></div>
  </div>
</section>

<section class="sessions">
  <div class="inner-sessions">
    <div id="operating-sys"></div>
    <div id="browser"></div>
  </div>
</section>

<section class="sessions">
  <div class="inner-sessions">
    <div id="avgSeshDuration"></div>
    <div id="bounce"></div>
  </div>
</section>

<section class="sessions">
  <div class="inner-sessions">
    <div id="gender"></div>
    <div id="age"></div>
  </div>
</section>


<!-- Step 2: Load the library. -->

<script>
(function(w,d,s,g,js,fjs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
  js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
}(window,document,'script'));
</script>

<script>
gapi.analytics.ready(function() {

  // Step 3: Authorize the user.

  var CLIENT_ID = '147508487728-sedqbsvfhj259k7093qhg392g4l7hr45.apps.googleusercontent.com';

  gapi.analytics.auth.authorize({
    container: 'auth-button',
    clientid: CLIENT_ID,
  });

  //document.write('<a href="index.php" onclick="signOut();">Sign out</a>');
  // Step 4: Create the view selector.

  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector'
  });


  // Step 5: Create the timeline chart.

  var timeline = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:date',
      'metrics': 'ga:sessions',
      'start-date': '7daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'LINE',
      container: 'timeline',
      options: {
        title: 'User Sessions In Last Week'
      }
    }
  });

  var timeline2 = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:date',
      'metrics': 'ga:sessions',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'LINE',
      container: 'timeline2',
      options: {
        title: 'User Sessions In Last Month'
      }
    }
  });

  var osChart = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:operatingSystem',
      'metrics': 'ga:sessions',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'BAR',
      container: 'operating-sys',
      options: {
        title: 'Operating Systems used to access YoGonzo last month'
      }
    }
  });

  var browserChart = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:browser',
      'metrics': 'ga:sessions',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'BAR',
      container: 'browser',
      options: {
        title: 'Browsers used to access YoGonzo last month'
      }
    }
  });

  var seshDuration = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:date',
      'metrics': 'ga:avgSessionDuration',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'LINE',
      container: 'avgSeshDuration',
      options: {
        title: 'Average Session Duration per day'
      }
    }
  });

  var bounceRate = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:date',
      'metrics': 'ga:bounceRate',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'LINE',
      container: 'bounce',
      options: {
        title: 'Daily Bounce Rate'
      }
    }
  });

  var gender = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:userGender',
      'start-date': '365daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'BAR',
      container: 'gender',
      options: {
        title: 'Gender of Users'
      }
    }
  });

 var age = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:userAgeBracket',
      'start-date': '365daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'BAR',
      container: 'age',
      options: {
        title: 'Age of Users'
      }
    }
  });



  // Step 6: Hook up the components to work together.

  gapi.analytics.auth.on('success', function(response) {
    viewSelector.execute();
  });

  viewSelector.on('change', function(ids) {
    var newIds = {
      query: {
        ids: ids
      }
    }
    timeline.set(newIds).execute();
    timeline2.set(newIds).execute();
    osChart.set(newIds).execute();
    browserChart.set(newIds).execute();
    seshDuration.set(newIds).execute();
    bounceRate.set(newIds).execute();
    age.set(newIds).execute();
    gender.set(newIds).execute();
  });

});
</script>

</body>
</html>