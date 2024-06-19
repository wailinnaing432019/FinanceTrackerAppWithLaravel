@extends('container.index')
@section('content')
    <section class="sec-second-income">
        <div class="container">
            <button id="inc-btn" class="btn rounded-pill">Income</button>
            <button id="exp-btn" class="btn rounded-pill">Expense</button>
            <form action="Tosavethedata to the database">
                <div class="form-group">
                    <label class="mb-3">Income</label>
                    <input type="number" class="form-control mb-3" placeholder="Enter Income...">
                </div>
                <div class="form-group">
                    <label class="mb-3">Notes</label>
                    <input type="text" class="form-control mb-3" placeholder="Enter notes..">
                </div>
                <div class="form-group">
                    <label class="mb-3">Date</label>
                    <input type="date" class="form-control mb-3" placeholder="Select Date...">
                </div>
                <div class="form-group">
                    <label class="mb-3">Time</label>
                    <input type="time" class="form-control mb-3" placeholder="Select Time...">
                </div>
                <button type="submit">Save</button>
                <button class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </section>
@endsection
