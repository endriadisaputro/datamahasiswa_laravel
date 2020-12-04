<table class="table">
	<thead>
		<tr>
			<th>NAMA</th>
			<th>JENIS KELAMIN</th>
			<th>AGAMA</th>
			<th>RATA-RATA NILAI</th>
		</tr>
	</thead>
	<tbody>
		@foreach($students as $s)
		<tr>
			<td>{{$s->nama_lengkap()}}</td>
			<td>{{$s->jenis_kelamin}}</td>
			<td>{{$s->agama}}</td>
			<td>{{$s->rataRataNilai()}}</td>
		</tr>
		@endforeach
	</tbody>
</table>