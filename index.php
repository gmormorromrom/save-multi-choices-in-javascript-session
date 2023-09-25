<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <link rel="stylesheet" href="/multiselection/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="/multiselection/jquery/3.6.0/jquery-3.6.0.min.js"></script>
    <script src="/multiselection/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <title>Save choices in javascript session</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-4 mb-4">Save choices in javascript session</h2> 
        <div class="alert alert-primary" role="alert">
            This app web exemple save multi-choices in javascript session to restore choices even after reloading the page
        </div>

        <span id="message"></span>
        <div class="card">
            <div class="card-header">Save multi-choices in javascript session to preserve choices</div>
            <div class="card-body">
                <div class="row justify-content-md-center">
                    <div class="col col-lg-6">
                        <div class="form-group">
                            <select name="country" id="country" class="form-control input-lg">
                                <option value="">Select Country</option>
                            </select>
                        </div><br>
                        <div class="form-group">
                            <select name="state" id="state" class="form-control input-lg">
                                <option value="">Select State</option>
                            </select>
                        </div><br>
                        <div class="form-group">
                            <select name="city" id="city" class="form-control input-lg">
                                <option value="">Select City</option>
                            </select>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {

        if (sessionStorage.getItem('city_id') && sessionStorage.getItem('country_id') && sessionStorage.getItem('country_id')) {
            $.ajax({
                url: "/multiselection/getCountry.php",
                method: "GET"
            }).done(function(data) {
                var html = '<option value="">Select Country</option>';

                for (var count = 0; count < data.length; count++) {
                    if (sessionStorage.getItem('country_id') == data[count].country_id) {
                        html += '<option selected="selected" value="' + data[count].country_id + '">' + data[count].country_name + '</option>';
                    } else {
                        html += '<option value="' + data[count].country_id + '">' + data[count].country_name + '</option>';
                    }
                }

                $('#country').html(html);
            });

            $.ajax({
                url: "/multiselection/getState.php?countryId=" + sessionStorage.getItem('country_id'),
                method: "GET",
                dataType: "JSON",
            }).done(function(data) {

                var html = '<option value="">Select State</option>';

                for (var count = 0; count < data.length; count++) {
                    if (sessionStorage.getItem('state_id') == data[count].state_id) {
                        html += '<option selected="selected" value="' + data[count].state_id + '">' + data[count].state_name + '</option>';
                    } else {
                        html += '<option value="' + data[count].state_id + '">' + data[count].state_name + '</option>';
                    }
                }

                $('#state').html(html);
            });

            $.ajax({
                url: "/multiselection/getCity.php?stateId=" + sessionStorage.getItem('state_id'),
                method: "GET"
            }).done(function(data) {
                var html = '<option value="">Select City</option>';

                for (var count = 0; count < data.length; count++) {
                    if (sessionStorage.getItem('city_id') == data[count].city_id) {
                        html += '<option selected="selected" value="' + data[count].city_id + '">' + data[count].city_name + '</option>';
                    } else {
                        html += '<option value="' + data[count].city_id + '">' + data[count].city_name + '</option>';
                    }
                }
                $('#city').html(html);
            });

        }
        if (!sessionStorage.getItem('country_id')) {
            $.ajax({
                url: "/multiselection/getCountry.php",
                method: "GET"
            }).done(function(data) {
                var html = '<option value="">Select Country</option>';

                for (var count = 0; count < data.length; count++) {
                    html += '<option value="' + data[count].country_id + '">' + data[count].country_name + '</option>';
                }

                $('#country').html(html);
            });
        }


        $('#country').change(function() {
            var country_id = $('#country').val();
            sessionStorage.setItem('country_id', country_id);

            if (country_id != '') {
                $.ajax({
                    url: "/multiselection/getState.php?countryId=" + country_id,
                    method: "GET",
                    dataType: "JSON",
                }).done(function(data) {

                    var html = '<option value="">Select State</option>';

                    for (var count = 0; count < data.length; count++) {

                        html += '<option value="' + data[count].state_id + '">' + data[count].state_name + '</option>';

                    }

                    $('#state').html(html);
                });
            } else {
                $('#state').val('');
            }
            $('#city').val('');
        });

        $('#state').change(function() {

            var state_id = $('#state').val();
            sessionStorage.setItem('state_id', state_id);
            if (state_id != '') {
                $.ajax({
                    url: "/multiselection/getCity.php?stateId=" + state_id,
                    method: "GET"
                }).done(function(data) {
                    var html = '<option value="">Select City</option>';

                    for (var count = 0; count < data.length; count++) {
                        html += '<option value="' + data[count].city_id + '">' + data[count].city_name + '</option>';
                    }

                    $('#city').html(html);
                });
            } else {
                $('#city').val('');
            }

        });
        $('#city').change(function() {
            var city_id = $('#city').val();
            sessionStorage.setItem('city_id', city_id);
        });
    });
</script>