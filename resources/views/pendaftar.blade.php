<?php
// filepath: resources\views\pendaftar\index.blade.php
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Pendaftar</h3>
            <a href="{{ route('pendaftar.create') }}" class="btn btn-primary float-end">Tambah Pendaftar</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telepon</th>
                        <th>Paket</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendaftars as $pendaftar)
                    <tr>
                        <td>{{ $pendaftar->nama }}</td>
                        <td>{{ $pendaftar->email }}</td>
                        <td>{{ $pendaftar->no_telepon }}</td>
                        <td>{{ $pendaftar->paket_dipilih }}</td>
                        <td>{{ $pendaftar->status_pendaftaran }}</td>
                        <td>
                            <a href="{{ route('pendaftar.edit', $pendaftar->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pendaftar.destroy', $pendaftar->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection