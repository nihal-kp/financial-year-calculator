<!DOCTYPE html>
<html lang="en">
<head>
  <title>Financial Year Calculator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center">Financial Year Calculator</h1>
        <div class="col-md-6 mx-auto">
            <form id="financial-year-form" action="{{ route('financial-year') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select id="country" class="form-select" name="country">
                    <option value="" selected disabled>--Select Country--</option>
                    <option value="GB">UK</option>
                    <option value="IE">Ireland</option>
                </select>
                <div class="text-danger" id="error_country"></div>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <select id="year" class="form-select" name="year">
                    <option value="" selected disabled>--Select Year--</option>
                </select>
                <div class="text-danger" id="error_year"></div>
            </div>
            <button type="submit" class="btn btn-primary">Get Financial Year</button>
            </form>

            <div class="spinner-border text-info mt-5" id="spinner" style="display: none; position: absolute; right: 50%;"></div>

            <div id="result" class="mt-4">
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const currentYear = new Date().getFullYear();

            $('#country').change(function() {
                const country = $(this).val();
                $('#year').empty().append('<option value="" selected disabled>--Select Year--</option>');

                if (country === 'IE') {
                    for (let year = currentYear - 10; year <= currentYear; year++) {
                        $('#year').append(`<option value="${year}">${year}</option>`);
                    }
                } else if (country === 'GB') {
                    for (let year = currentYear - 10; year <= currentYear; year++) {
                        $('#year').append(`<option value="${year}">${year}-${(year + 1).toString().slice(-2)}</option>`);
                    }
                }
            });

            $('#financial-year-form').submit(function(e) {
                e.preventDefault();
                $this = $(this);
                $('.text-danger').html('').hide();
                $('#result').html('');

                $.ajax({
                    url: $this.attr('action'),
                    type: 'POST',
                    data: $this.serialize(),
                    beforeSend: function() {
                        $('#spinner').show();
                    },
                    success: function(response){ 
                        $('#result').html(`
                            <h3>Financial Year Details</h3>
                            <p>Financial Year Start: ${response.start}</p>
                            <p>Financial Year End: ${response.end}</p>
                            <p>Public Holidays:</p>
                            <ul>
                                ${response.holidays.map(holiday => `<li>${holiday.name} (${holiday.date})</li>`).join('')}
                            </ul>
                        `);
                    },
                    error: function(response){
                        $.each(response.responseJSON.errors, function(key,value) {
                            $('#error_'+key).html(value).show();
                        });
                    },
                    complete: function() {
                        $('#spinner').hide();
                    },
                });
            });
        });
    </script>
</body>
</html>