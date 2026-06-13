<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Jurusan</th>
        <th>Akreditasi</th>
        <th>Total Mahasiswa</th>
        <th>Total Matakuliah</th>
    </tr>

    @foreach($jurusans as $j)
    <tr>
        <td>{{ $j->id_jurusan }}</td>
        <td>{{ $j->nama_jurusan }}</td>
        <td>{{ $j->akreditasi }}</td>
        <td>{{ $j->mahasiswas->count() }}</td>
        <td>{{ $j->matakuliahs->count() }}</td>
    </tr>
    @endforeach
</table>