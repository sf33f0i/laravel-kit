<div class="table-responsive">
    @php
        if (!empty($responses) && is_array($responses)) {
        /** @var $responses array[] */
        $table = '<table data-role="gridView" class="table">';
        $table .= '<thead><tr>';
        foreach (array_keys($responses[0]) as $columnName) {
            $table .= '<th>' . $columnName . '</th>';
        }
        $table .= '</tr></thead>';
        $table .= '<tbody>';
        foreach ($responses as $response) {
            $table .= '<tr>';
            foreach ($response as $cell) {
                $table .= '<td>';
                if (!is_array($cell)) {
                    $table .= $cell;
                } else {
                    foreach ($cell as $key => $value) {
                        $table .= $value . ' ';
                    }
                }
                $table .= '</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';

        echo $table;
    }
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('[data-role="gridView"]').DataTable();
        });
    </script>
</div>
