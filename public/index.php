<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="build/index.css">
    <style>
        html {
            height: 100%
        }

        body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        #map-canvas {
            height: 100%
        }
    </style>
</head>
<body>

<div id="map-canvas"></div>
<script type="application/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="data.js"></script>
<script src="testData.js"></script>
<script src="test/build/heatmap.min.js"></script>
<script src="test/plugins/gmaps-heatmap/gmaps-heatmap.js"></script>
<script>
    const myLatlng = new google.maps.LatLng(52.6586, 21.3568);

    const myOptions = {
        zoom: 6,
        center: myLatlng
    };

    const map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
    heatmap = new HeatmapOverlay(map,
        {
            radius: 20,
            maxOpacity: .6,
            scaleRadius: 0,
            minOpacity: 0,
            useLocalExtrema: false,
            blur: .2,
            latField: 'lat',
            lngField: 'lng',
            valueField: 'count'
        }
    );


    const result = [];

    testData.forEach(item => {
        const arr = data.filter(obj => {
            return obj.post_code === item;
        });
        result.push(arr[0]);
    });

    const clearResult = [];

     result.forEach(item => {
         if(item !== undefined) {
             let count = 1;
             if(item.post_code === '26-050')  {
                 count = 5;
             }
             else count = 1;
             clearResult.push({
                 lat: item.lat,
                 lng: item.lng,
                 count: count,
             });
         }
     });

    const heatData = {
        max: 15,
        data: clearResult
    };
    console.timeEnd('drawing');
    heatmap.setData(heatData);
</script>
</body>
</html>