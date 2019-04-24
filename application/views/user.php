
    <div class="row">
        <h3>Daftar User</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 0; foreach($PS_USER as $card) { $no++; ?>
                <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td><?= $card['UserID']; ?></td>
                    <td><?= $card['Email']; ?></td>
                    <td>
                        
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

