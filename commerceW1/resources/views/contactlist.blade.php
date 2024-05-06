@extends("template.main")
@section('title', 'Contact List')
@section('body')
<div class="container mt-5">
    <h2>Contact List</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Message</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($contacts as $index => $contact)
        <tr>
          <td>{{ $contact['name'] }}</td>
          <td>{{ $contact['email'] }}</td>
          <td>{{ $contact['phone'] }}</td>
          <td>{{ $contact['message'] }}</td>
          <td>
              <form action="{{ route('delete.contact', ['index' => $index]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection
