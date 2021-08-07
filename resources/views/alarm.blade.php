<table border="1">
	<tr>
		<th>Isi</th>
		<th>tanggal</th>
		<th>Waktu</th>
		<th>pengulangan</th>
		<th>action</th>
	</tr>
	@foreach($data as $d)
	<tr>
		<td>
			{{$d->isi}}
			<input type="hidden" name="" id="isi" value="{{$d->isi}}" readonly style="border: none;">
		</td>
		<td>
			{{$d->tanggal}}
			<input type="hidden" name="" id="date" value="{{$d->tanggal}}" readonly style="border: none;">
		</td>
		<td>
			{{$d->waktu}}
			<input type="hidden" name="" class="time" value="{{$d->waktu}}" readonly style="border: none;">
		</td>
		<td>
			{{$d->pengulangan}}
			<input type="hidden" name="" id="pengulangan" value="{{$d->pengulangan}}" readonly style="border: none;">
		</td>
		<td><button class="hapus" id="{{$d->id}}">delete</button></td>
	</tr>
	@endforeach
</table>