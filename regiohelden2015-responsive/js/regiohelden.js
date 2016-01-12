/* Google Map */
var howMany = 200;
var maxWait = 1; 
var maxDelay = 0;
var latitudeSort = function(a, b) {
    return b[1] - a[1]
};
var sitesIcon = {
    url: 'http://mt.google.com/vt/icon?color=ff004C13&name=icons/spotlight/spotlight-waypoint-blue.png&scale=2',
    size: new google.maps.Size(18, 33),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 33),
    scaledSize: new google.maps.Size(18, 33)
}
var infowindow = null;
$(document).ready(function() {
    initialize();
});
function initialize() {
    var centerMap = new google.maps.LatLng(51.051526,9.662452);
    var myOptions = {
        zoom: 5,
        center: centerMap,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        draggable: false,
        mapTypeControl: false,
        streetViewControl: false,
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var styles = [
    {
    stylers: [
    { hue: "#f28722" },
    { saturation: 50 },
    { gamma: 1.51 }
    ]
    },{
    featureType: "road",
    elementType: "geometry",
    stylers: [
      { hue: "#f28722" },
      { visibility: "off" },
      { saturation: 50 }
    ]
    },{
    featureType: "water",
    stylers: [
      { hue: "#4285f4" },
      { saturation: 100 }
    ]
    },{
    elementType: "labels",
    stylers: [
    { visibility: "on" }
    ]
    },{
    featureType: "administrative.locality",
    elementType: "labels",
    stylers: [
    { visibility: "off" }
    ]
    }
    ];
    map.setOptions({styles: styles});
    google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
        setMarkers(map, sites);
    });
    infowindow = new google.maps.InfoWindow({
        content: "laden..."
    });
}

function setMarkers(map, markers) {
    markers.splice(0, 200 - howMany);
    markers.sort(latitudeSort);

    for (var i = 0; i < markers.length; i++) {
        var sites = markers[i];
        var siteLatLng = new google.maps.LatLng(sites[1], sites[2]);
        (function(i, siteLatLng, sites) {
            setTimeout(function() {
                var marker = new google.maps.Marker({
                    position: siteLatLng,
                    map: map,
                    title: sites[0],
                    zIndex: sites[3],
                    html: sites[4],
                    icon: sitesIcon,
                    size: new google.maps.Size(5, 5),
                    animation: google.maps.Animation.DROP
                });

                var contentString = "Some content";
                google.maps.event.addListener(marker, "click", function() {
                    infowindow.setContent(this.html);
                    infowindow.open(map, this);
                });
            }, i * Math.min(maxWait * 1000 / markers.length, maxDelay));
        }(i, siteLatLng, sites));
    }
}
var sites = [
    ['Stuttgart', 48.771611,9.171408, 1, "<a href='/ueber-uns/standorte/'><b>Hauptsitz Stuttgart</b></a><br>Marienstraße 23<br>70178 Stuttgart<br>Tel: +49 711 128 501-0"],
    ['Berlin', 52.5389969, 13.4117445, 1, "<a href='/ueber-uns/standorte/'><b>Büro Berlin</b></a><br>Schönhauser Allee 149<br>10435 Berlin<br>Tel: +49 30 9599 841 41"],
    ['Hamburg', 53.66284, 10.007029, 1, "<a href='/ueber-uns/standorte/'><b>Büro Hamburg</b></a><br>Oehleckerring 22-24<br>22419 Hamburg<br>Tel: +49 711 128 501-0"],
    ['Koeln', 50.920172,6.848852, 1, "<a href='/ueber-uns/standorte/'><b>Büro Köln</b></a><br>Max-Planck-Str. 22<br>50858 Köln<br>Tel: +49 221 291 913 23"],
    ['Muenchen', 48.118191,11.5521, 1, "<a href='/ueber-uns/standorte/'><b>Büro München</b></a><br>Kochelseestraße 8-10<br>81371 München<br>Tel: +49 89 12 50 929 71"],
    ['Zuerich', 47.387699, 8.51903, 1, "<a href='/ueber-uns/standorte/'><b>AZ RegioHelden AG</b></a><br>Hardstrasse 235<br>8005 Zürich<br>Tel: +41 44 5159270"],
    ];

/* FANCYBOX START */
$(document).ready(function() {
    $(".fancybox").fancybox({
        'centerOnScroll' : true,
        'width'          : '75%',
        'height'          : '85%',

    });
    $(".ms-image a").attr('rel', 'gallery').fancybox({

        beforeShow : function() {
            var alt = this.element.find('img').attr('alt');
            this.inner.find('img').attr('alt', alt);
            this.title = alt;
        },

        'centerOnScroll' : true,
        'width'          : '75%',
        'height'          : '85%',
        helpers : {
                    title : {
                        type : 'inside'
                    }
                }
    });
    /* FANCYBOX END */

    $("#mmenu-navi").mmenu({
        counters: true
    });
    /* $("#menu-item-1251 a").addClass("fancybox fancybox.iframe"); */
});
/* FIXED MOBILE MENU */
$( window ).resize(function() {
    if ($(window).width() < 660) {
        $(window).bind('scroll', function () {
            if ($(window).scrollTop() > 185) {
                $('.orange-top').addClass('fixed-top');
            } else {
                $('.orange-top').removeClass('fixed-top');
            }
        });
    }
    else {
        $(window).bind('scroll', function () {
            if ($(window).scrollTop() > 131) {
                $('.orange-top').addClass('fixed-top');
            } else {
                $('.orange-top').removeClass('fixed-top');
            }
        });
    }
});
if ($(window).width() < 660) {
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 185) {
            $('.orange-top').addClass('fixed-top');
        } else {
            $('.orange-top').removeClass('fixed-top');
        }
    });
}
else {
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 131) {
            $('.orange-top').addClass('fixed-top');
        } else {
            $('.orange-top').removeClass('fixed-top');
        }
    });
}