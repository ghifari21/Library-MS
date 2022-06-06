    <div class="container-fluid mx-auto my-5 col-lg-6">
        <form action="/books" method="POST">
            <div class="input-group">
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                @if (request('publisher'))
                    <input type="hidden" name="publisher" value="{{ request('publisher') }}">
                @endif
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit" id="search"><i class="bi bi-search"></i> Search</button>
            </div>
        </form>
    </div>
