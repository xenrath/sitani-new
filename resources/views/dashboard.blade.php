@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<h4 class="fw-bold py-3 mb-4">Dashboard</h4>
<div class="card">
  <h5 class="card-header">Tabel User</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th class="text-center">No.</th>
          <th>Nama User</th>
          <th>No. Telepon</th>
          <th class="text-center">Role</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr>
          <td class="text-center">1</td>
          <td>Nama</td>
          <td>+6289012345678</td>
          <td class="text-center">
            <span class="badge bg-label-primary">Admin</span>
          </td>
        </tr>
        <tr>
          <td class="text-center">1</td>
          <td>Nama</td>
          <td>+6289012345678</td>
          <td class="text-center">
            <span class="badge bg-label-primary">Admin</span>
          </td>
        </tr>
        <tr>
          <td class="text-center">1</td>
          <td>Nama</td>
          <td>+6289012345678</td>
          <td class="text-center">
            <span class="badge bg-label-primary">Admin</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection