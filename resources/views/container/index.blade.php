<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Tracker</title>
    {{-- <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('container/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('container/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    @if (Session::has('error'))
        <script>
            swal("Message", "{{ Session::get('error') }}", 'error', {
                button: true,
                button: "OK",
                timer: 9000,
                dangerMode: true,
            })
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "OK",
                timer: 9000,
                dangerMode: false,
            })
        </script>
    @endif
    <section class="sec-mv">
        <header>
            <div class="l-container clearfix">
                <nav class="fnav clearfix">
                    <ul class="clearfix">
                        @yield('download')
                        <li><a href="\summary" class="text-dark">Summary</a></li>
                        {{-- <div class="search-box">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div> --}}
                        @yield('search')
                    </ul>
                </nav>
                <div class="nav-bar">
                    <p class="menu-toggle">
                        <span style="font-size: 5px"></span>
                        <span style="font-size: 5px"></span>
                        <span style="font-size: 5px"></span>
                    </p>
                    <nav class="gnav clearfix  border-right-3">
                        <div class="profile">
                            <a href="\viewPf"><i class="fa-solid fa-user"></i>{{ auth()->user()->name }}</a>
                        </div>
                        <ul class="clearfix">
                            <li><a href="\account">Account</a></li>
                            <li><a href="\summary">Summary</a></li>
                            <li><a href="\transfer">Transfer</a></li>
                            <li><a href="\transactions">Transactions</a></li>
                        </ul>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="common-btn logout">Log out</button>
                        </form>
                    </nav>
                </div>
            </div>
        </header>
    </section>
    <div style="padding-top: 100px;">
        @yield('content')
    </div>
    {{-- <section class="sec-second">
      <div class="container">
        <div class="tabs">
          <ul id="tabs-nav">
            <li><a href="#tab1">All</a></li>
            <li><a href="#tab2">Daily</a></li>
            <li><a href="#tab3">Weekly</a></li>
            <li><a href="#tab4">Monthly</a></li>
            <li><a href="#tab5">Yearly</a></li>
          </ul>
          <div id="tabs-content">
            <div id="tab1" class="tab-content">
              <h2>All</h2>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Iusto, perferendis. Commodi ratione et veritatis porro dicta?
                Corporis molestiae vero, tempora aperiam repellendus, laborum
                facere blanditiis fuga enim sapiente, minus a.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Deserunt repellendus neque, dolorum, inventore error doloremque
                impedit, provident facilis voluptatem cum quas. Facere ut
                nostrum, nemo dolor tenetur mollitia corrupti iusto?
              </p>
            </div>
            <div id="tab2" class="tab-content">
              <h2>Daily</h2>
              <p>This is daily.</p>
            </div>
            <div id="tab3" class="tab-content">
              <h2>Weekly</h2>
              <p>This is weekly.</p>
            </div>
            <div id="tab4" class="tab-content">
              <h2>Monthly</h2>
              <p>This is monthly.</p>
            </div>
            <div id="tab5" class="tab-content">
              <h2>Yearly</h2>
              <p>This is yearly.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="sec-third">
      <div class="container">
        <div class="btn-container">
          <a href="income_expense.html" class="btn btn-success">Income</a>
          <a href="income_expense.html" class="btn btn-danger">Expense</a>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Total Income</th>
                <th scope="col">Total Expense</th>
                <th scope="col">Balance</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>0.0</td>
                <td>0.0</td>
                <td>0.0</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section> --}}

    <script src="{{ asset('container/js/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="{{ asset('container/js/common.js') }}"></script>
    <script src="{{ asset('container/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
