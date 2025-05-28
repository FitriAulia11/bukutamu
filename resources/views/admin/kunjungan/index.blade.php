<table class="table">
    <thead>
        <tr>
            <th>Nama Tamu</th>
            <th>Jumlah Kunjungan</th>
            <th>Riwayat Kunjungan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($daftarTamu as $tamu)
            <tr>
                <td>{{ $tamu->nama }}</td>
                <td>{{ $tamu->kunjungans->count() }} kali</td>
                <td>
                    <ul>
                        @foreach ($tamu->kunjungans as $kunjungan)
                            <li>{{ $kunjungan->waktu_kunjungan->format('d M Y H:i') }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
