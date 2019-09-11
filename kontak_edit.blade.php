@extends('template')
@section('content')
    <section class="main-section">
      <div class="content">
        <h1>Ubah Kontak</h1>
        <hr>
        @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div>
        @endif

        @foreach($data as $datas)
        <form action="{{ route('kontak.update', $datas->id) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="form-group">
            <label for="nama">Nama :</label>
            <input type="text" class="form-control" id="usr" name="nama" value="{{ $datas->nama }}">
          </div>
          <div class="form-group">
            <label for="email">Email :</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $datas->email }}">
          </div>
          <div class="form-group">
            <label for="nohp">No HP :</label>
            <input type="text" class="form-control" id="nohp" name="nohp" value="{{ $datas->nohp }}">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat :</label>
            <textarea class="form-control" id="alamat" name="alamat">{{ $datas->alamat }}</textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-md btn-primary">Submit</button>
            <button type="reset" class="btn btn-md btn-danger">Cancel</button>
          </div>
        </form>
        @endforeach
      </div>
    </section>
@endsection
