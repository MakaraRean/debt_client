<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/debt.js') }}"></script>
    <!------ Include the above in your HEAD tag ---------->
    {{-- <style>
        .navbar {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 0rem 0.5rem;
            background-color: #009df2;



        }

        .navbar-expand-lg .navbar-nav .nav-link {
            padding-right: 1rem;
            padding-left: 1rem;
            color: #FFF;
        }

        .navbar-nav {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;

        }

        .navbar-brand {
            display: inline-block;
            padding-top: 0.3125rem;
            padding-bottom: 0.3125rem;
            margin-right: 0rem;
            font-size: 1.25rem;
            line-height: inherit;
            white-space: nowrap;


        }

        .navbar-nav .nav-link {
            padding-right: 0;
            padding-left: 0;
        }

        .navbar-nav .dropdown-menu {
            position: static;
            float: none;
        }

        ul {
            list-style: none;
            width: 100%;
        }

        li {
            display: inline-block;
            width: 12.5%;
            text-align: center;
            border-right-width: 0.15mm;
            border-left-width: .15mm;
            border-right-style: solid;
            border-left-style: solid;
            border-right-color: #eee;
            border-left-color: #eee;
            font-family: 'Oswald', sans-serif;
            font-size: 15px;
            margin-right: 1px;
        }

        @media (max-width:576px) {

            ul {
                list-style: none;
                width: 100%;
            }

            li {
                display: inline-block;
                width: 100%;
                padding: 0;
                text-align: center;
                border-right-width: thin;
                border-left-width: thin;
                border-right-style: solid;
                border-left-style: solid;
                border-right-color: #CCC;
                border-left-color: #CCC;
            }


        }



        .navbar-light .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-light .navbar-nav .nav-link:focus,
        .navbar-light .navbar-nav .nav-link:hover {
            color: rgba(255, 255, 255, 0.7);
        }

        .navbar-light .navbar-nav .nav-link.disabled {
            color: rgba(255, 255, 255, 0.3);
        }

        .navbar-light .navbar-nav .show>.nav-link,
        .navbar-light .navbar-nav .active>.nav-link,
        .navbar-light .navbar-nav .nav-link.show,
        .navbar-light .navbar-nav .nav-link.active {
            color: rgba(0, 0, 0, 0.9);
        }

        .navbar-light .navbar-toggler {
            color: #FFF;
            border-color: #FFF;
        }

        .navbar-light .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(235, 235, 235, 0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            font-weight: normal;
        }

        .navbar-light .navbar-text {
            color: rgba(0, 0, 0, 0.5);
        }

        .navbar-light .navbar-text a {
            color: rgba(0, 0, 0, 0.9);
        }

        .navbar-light .navbar-text a:focus,
        .navbar-light .navbar-text a:hover {
            color: rgba(0, 0, 0, 0.9);
        }
    </style> --}}
    <style>
        .logo {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-dark fixed-top" data-bs-theme="dark">
        <div class="container-fluid justify-content-center">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.jpg') }}" alt="Home" class="logo">
            </a>
            <a class="navbar-brand nav-link active" href="#">Navbar</a>
            <a class="navbar-brand" href="#">Navbar</a>
            <a class="navbar-brand" href="#">Navbar</a>
        </div>
    </nav>

    <div class="container" style="margin-top: 70px">
        <ul class="nav nav-tabs" id="myTab">
            <li class="nav-item">
                <a class="nav-link active" href="" id="listOfDebts">List of
                    debtors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" id="newDebt">New</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" id="payDebt" role="button">Pay</a>
            </li>
        </ul>

        @yield('content')
    </div>

    <script>
        const triggerTabList = document.querySelectorAll('#myTab a')
        const listOfDebt = document.getElementById('contentListOfDebt');
        const newDebt = document.getElementById('contentNewDebt');
        const payDebt = document.getElementById('contentPayDebt');
        triggerTabList.forEach(triggerEl => {
            const tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', event => {
                event.preventDefault()
                tabTrigger.show()
                if (tabTrigger._element.id == 'listOfDebts') {
                    // Show List of Debts
                    listOfDebt.style.display = "block";
                    newDebt.style.display = "none";
                    payDebt.style.display = "none";
                } else if (tabTrigger._element.id == 'newDebt') {
                    listOfDebt.style.display = "none";
                    newDebt.style.display = "block";
                    payDebt.style.display = "none";
                } else {
                    // Show form to edit or form to pay any debt
                    payDebt.style.display = "block";
                    listOfDebt.style.display = "none";
                    newDebt.style.display = "none";
                }
            })
        })

        // Show select option under input
        function debtorSuggestion() {
            var inputText = $('#debtor').val().toLowerCase();
            var dropdownOptions = $('#dropdownOptions');

            // Clear previous options
            dropdownOptions.empty();

            // Generate and append new options
            for (var i = 0; i < suggestionDebtors.length; i++) {
                var option = suggestionDebtors[i];
                var optName = option.name.toLowerCase();
                if (optName.includes(inputText)) {
                    var listItem = $('<a>').addClass('dropdown-item').text(suggestionDebtors[i].name + " " + option.address)
                        .attr('data-id', option.id);
                    console.log(listItem);
                    dropdownOptions.append(listItem);
                }
            }

            // Show or hide dropdown options based on the input text
            if (inputText.length > 0 && dropdownOptions.children().length > 0) {
                dropdownOptions.show();
            } else {
                dropdownOptions.hide();
            }
        };

        function debtSuggestion() {
            var inputText = $('#debt').val().toLowerCase();
            var dropdownOptions = $('#dropdownOptionDebt');

            // Clear previous options
            dropdownOptions.empty();

            // Generate and append new options
            for (var i = 0; i < suggestedOptions.length; i++) {
                var option = suggestedOptions[i].toLowerCase();
                if (option.includes(inputText)) {
                    var listItem = $('<a>').addClass('dropdown-item').text(suggestedOptions[i]);
                    dropdownOptions.append(listItem);
                }
            }

            // Show or hide dropdown options based on the input text
            if (inputText.length > 0 && dropdownOptions.children().length > 0) {
                dropdownOptions.show();
            } else {
                dropdownOptions.hide();
            }
        };
        // Handle option selection
        $(document).on('click', '#dropdownOptionDebt a', function() {
            var selectedOption = $(this).text();
            $('#debt').val(selectedOption);
            $('#dropdownOptionDebt').hide();
        });

        //Handle debtor selection
        $(document).on('click', '#dropdownOptions a', function() {
            var selectedOption = $(this).text();
            var selectedId = $(this).data('id');
            $('#debtorId').val(selectedId);
            $('#debtor').val(selectedOption);
            $('#debtor').prop('disabled', true);
            $('#addNewDebt').prop('disabled', false);
            $('#dropdownOptions').hide();
        });

        // Handle pay some checkbox
        $(document).on('click', '#paySomeCheckbox', function() {
            // Check if checkbox is checked
            if ($(this).is(':checked')) {
                // Show the element
                $('#divPaySome').show();
            } else {
                $('#divPaySome').hide();
            }
        });
        // Example of suggested options (can be fetched from an API or a predefined list)
        var suggestedOptions = [
            'Apple',
            'Banana',
            'Orange',
            'Pineapple',
            'Grapes',
            'Mango',
            'Strawberry'
        ];


        $(document).ready(function() {
            // Make http request to get all the debtors and add them to table
            $('#btnSaveDebtorSpinner').hide();
            $('#btnSaveDebtSpinner').hide();
            var spinner = document.getElementById('loadingSpinner');
            spinner.style.display = 'block';
            $.ajax({
                url: "https://makaracoreapi.reanmakara.xyz/api/debt/get",
                type: "GET",
                success: function(response) {
                    console.log(response.content);

                    function addDebtorToTable(debtor) {
                        let debtorRow = '';
                        $.ajax({
                            url: 'https://makaracoreapi.reanmakara.xyz/api/debtor/get?id=' +
                                debtor.debtor_id,
                            type: "GET",
                            success: function(res) {
                                if (debtor.is_paid) {
                                    debtorRow = `<tr class="table-success text-decoration-line-through">
                                    <th>${debtor.id}</th>
                                    <th>${res.content[0].name}</th>
                                    <th>${res.content[0].sex}</th>
                                    <th>${res.content[0].address}</th>
                                    <th>${debtor.amount}</th>
                                </tr>`;
                                } else {
                                    debtorRow = `<tr class="table-warning">
                                    <th>${debtor.id}</th>
                                    <th>${res.content[0].name}</th>
                                    <th>${res.content[0].sex}</th>
                                    <th>${res.content[0].address}</th>
                                    <th>${Number(debtor.amount).toLocaleString()} រៀល</th>
                                </tr>`;
                                }

                                $('#tableBody').append(debtorRow);
                            }
                        });
                    }

                    if (response.status == 200) {
                        // Foreach debtor in the response content, add it to the table
                        response.content.forEach(debtor => {
                            addDebtorToTable(debtor);
                        });
                        spinner.style.display = 'none';
                    }
                },
                error: function(error) {
                    console.log(error);
                }

            });
        });


        // When debtor name input on focus
        function getDebtor_onFocus() {
            $.ajax({
                url: "https://makaracoreapi.reanmakara.xyz/api/debtor/get",
                type: "GET",
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        suggestionDebtors = response.content;
                    }
                },
                error: function(error) {
                    console.log(error);
                }

            });
        };
        var suggestionDebtors = [];
    </script>
</body>

</html>
