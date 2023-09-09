<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Business Casual - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />        
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />

    </head>
    <body>
        <header>
            <h1 class="site-heading text-center text-faded d-none d-lg-block">
                <span class="site-heading-upper text-primary mb-3">A Free Bootstrap Business Theme</span>
                <span class="site-heading-lower">Business Casual</span>
            </h1>
        </header>
        <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div id='map' style='width: 1200px; height: 600px;'></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-9 mx-auto pt-5">
                        <h3>Filter</h3>
                        <select name="filter" id="filter" class="form-control mb-3" onchange="filter()">
                            <option value="menu" default>Select By Menu</option>
                            <option value="places">Select By Place</option>
                        </select>
                        <input type="text" name="search" id="search" class="form-control">
                        <button type="button" class="form-control btn btn-dark mb-3" onclick="search()">Search</button>
                        <table id="dataTable" class="table table-striped">
                            <thead class="table-dark">
                                <th>NO</th>
                                <th id="filtered">Menu</th>
                                <th>Jumlah</th>
                            </thead>
                            <tbody >
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xl-9">
                        <span id="count"></span>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer text-faded text-center py-5">
            <div class="container"><p class="m-0 small">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script type="text/javascript">
            function load(){
                $.ajax({
                    url : '/home',
                    method : 'get',
                    data:{},
                    success : function(data){
                        $.each(data, function(key,value){
                            $('#dataTable tbody').append(`
                                <tr>
                                    <td>${key +1 }</td>
                                    <td>${value.result}</td>
                                    <td>${value.count}</td>
                                </tr>
                            `);
                        })
                        console.log(data)
                    }
                })
            }
            load();

            function filter(){
                var filter = $('#filter').val();
                $.get('/filter',{f:filter},function(data,status,jqXHR){
                    $('#dataTable tbody tr').remove();
                    $.each(data, function(key,value){
                            $('#dataTable tbody').append(`
                                <tr>
                                    <td>${key +1 }</td>
                                    <td>${value.result}</td>
                                    <td>${value.count}</td>
                                </tr>
                            `);
                        })
                })
            }

            function search(){
                var filter = $('#filter').val();
                var search = $('#search').val();

                $.get('/search',{f:filter,s:search},function(data,status,jqXHR){
                    $('#dataTable tbody tr').remove();
                    $.each(data, function(key,value){
                            $('#dataTable tbody').append(`
                                <tr>
                                    <td>${key +1 }</td>
                                    <td>${value.result}</td>
                                    <td>${value.count}</td>
                                </tr>
                            `);
                        })
                })
            }
            // TO MAKE THE MAP APPEAR YOU MUST
            // ADD YOUR ACCESS TOKEN FROM
            // https://account.mapbox.com
            accessToken = 'pk.eyJ1IjoiYXJrYW5mYXV6YW45MyIsImEiOiJja3U2djJtYjcycm00Mm5vcTh0bHJxMmh6In0.8p3Sy60ztY0-uY-UTZSFHQ'
            mapboxgl.accessToken = accessToken;
            const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v12', // style URL
            center: [-74.5, 40], // starting position [lng, lat]
            zoom: 9, // starting zoom
            });

            // map.on('click',(e)=>{
            //     //reverse geocoding to get address by latitude and longitude
            //     $.get(`https://api.mapbox.com/geocoding/v5/mapbox.places/${e.lngLat['lng']},${e.lngLat['lat']}.json?access_token=${accessToken}`,function(data, status){
            //         document.getElementById('address').value=data.features[0].place_name;
            //         document.getElementById('coord').value=`${e.lngLat['lng']},${e.lngLat['lat']}`
            //         // map.flyTo({
            //         //     //recenter map to clicked location
            //         //     center: [e.lngLat['lng'],e.lngLat['lat']]
            //         // });
            //         event.preventDefault();
            //         $.ajaxSetup({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             }
            //         });
            //         $.ajax(
            //             {
            //                 url : "add",
            //                 type :"POST",
            //                 dataType: "json",
            //                 data : {
            //                     c:`${e.lngLat['lng']},${e.lngLat['lat']}`,
            //                     a:data.features[0].place_name,
            //                 },
            //                 success :function(count){
            //                     document.getElementById('count').innserHTML = count;
            //                 }
            //             }
            //         )

            //     })
            // })

        </script>
    </body>
</html>

 