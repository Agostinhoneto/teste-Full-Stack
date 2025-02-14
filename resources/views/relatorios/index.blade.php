@include('layouts.topo')
@include('layouts.sidebar')


<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="container my-4">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Relatórios</h3>
                <button class="btn btn-light btn-sm" onclick="window.print()">
                    <i class="fas fa-print"></i> Imprimir
                </button>
            </div>

            <div class="card-body">
                <!-- Filtros -->
                <form method="GET" action="{{ url('/reports') }}" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label for="data_inicial" class="form-label">Data Inicial:</label>
                        <input type="date" name="data_inicial" id="data_inicial" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <label for="data_final" class="form-label">Data Final:</label>
                        <input type="date" name="data_final" id="data_final" class="form-control">
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                    </div>
                </form>

                <!-- Tabela de Relatórios -->
                <div class="table-responsive mt-4">
                    <table id="tabela-relatorios" class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th>Nome do Colaborador</th>
                                <th>Email</th>
                                <th>Data de Cadastro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($colaborador as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>{{ $c->nome }}</td>
                                <td>{{ $c->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#tabela-relatorios').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "order": [
                [3, "desc"]
            ], // Ordenar por data de cadastro
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#tabela-relatorios_wrapper .col-md-6:eq(0)');
    });
</script>