@extends('plantilla.plantilla_expedients')

@section('contenido')
<div class="row">
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th>Estat</th>
                    <th>id</th>
                    <th>Codi Expedient</th>
                    <th>Mes dades</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expedients as $expedient)
                    <tr>
                        <td>{{ $expedient->estat_expedients_id }}</td>
                        <td>{{ $expedient->id }}</td>
                        <td>{{ $expedient->codi }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2-open" viewBox="0 0 16 16">
                                    <path d="M2 4a2 2 0 0 1 2-2h6.586a1 1 0 0 1 .707.293l2.414 2.414a1 1 0 0 1 .293.707v7.586a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v2h8V4a1 1 0 0 0-1-1H4z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mes dades</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Codi Trucada</th>
                            <th>Codi Expedient</th>
                            <th>Telefon</th>
                            <th>Data i Hora</th>
                            <th>Dades trucada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expedient->cartes_trucades as $carta)
                            <tr>
                                <td>{{ $carta->codi_trucada }}</td>
                                <td>{{ $carta->expedient_id }}</td>
                                <td>{{ $carta->telefon }}</td>
                                <td>{{ $carta->data_hora_trucada }}</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fas fa-folder"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <select class="form-control">
                    <option>En procés</option>
                    <option>Sol·licitat</option>
                    <option>Acceptat</option>
                    <option>Tancat</option>
                    <option>Immobilitzat</option>
                </select>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <nav class="navbar navbar-expand-md navbar-light bg-light flex-column">
                                <h5 class="navbar-brand mb-0">Navbar</h5>
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#section1">Identificació de la trucada</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#section2">Nota comuna</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#section3">Localització de l'emergència</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#section4">Tipificació de l'emergència</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#section5">Agencies</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-md-9">
                            <div id="section1">
                                <h5>Identificació de la trucada</h5>
                                    @foreach($expedient->cartes_trucades as $carta)
                                        <div class="form-group">
                                            <label for="codi">Codi</label>
                                            <input type="text" class="form-control" id="codi" name="codi" value="{{ $carta->codi_trucada }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="telefon">Número de telèfon</label>
                                            <input type="text" class="form-control" id="telefon" name="telefon" value="{{ $carta->telefon }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="adreca">Adreça</label>
                                            <input type="text" class="form-control" id="adreca" name="adreca" value="{{ $carta->descripcio_localitzacio }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="municipi">Municipi</label>
                                            <input type="text" class="form-control" id="municipi" name="municipi" value="{{ $carta->municipis_id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="comarca">Comarca</label>
                                            <input type="text" class="form-control" id="comarca" name="comarca" value="{{ $carta->provincia_id }}">
                                        </div>
                                    @endforeach
                            </div>
                            <div id="section2">
                                <h5>Nota comuna</h5>
                                <!-- Aquí va el cuadro de texto de la sección 2 -->
                            </div>
                            <div id="section3">
                                <h5>Localització de l'emergència</h5>
                                    @foreach($expedient->cartes_trucades as $carta)
                                        <div class="form-group">
                                            <label for="adreca">Adreça</label>
                                            <input type="text" class="form-control" id="adreca" name="adreca" value="{{ $carta->descripcio_localitzacio }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="municipi">Municipi</label>
                                            <input type="text" class="form-control" id="municipi" name="municipi" value="{{ $carta->municipis_id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="comarca">Comarca</label>
                                            <input type="text" class="form-control" id="comarca" name="comarca" value="{{ $carta->provincies_id }}">
                                        </div>
                                    @endforeach
                            </div>
                            <div id="section4">
                                <h5>Tipificació de l'emergència</h5>
                                <!-- Aquí van los campos de la sección 4 -->
                            </div>
                            <div id="section5">
                                <h5>Agencies</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>
                                                <select class="form-control">
                                                    <option>En procés</option>
                                                    <option>Finalitzat</option>
                                                    <option>Contactat</option>
                                                </select>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Agència 1</td>
                                            <td>
                                                <select class="form-control">
                                                    <option>En procés</option>
                                                    <option>Finalitzat</option>
                                                    <option>Contactat</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Agència 2</td>
                                            <td>
                                                <select class="form-control">
                                                    <option>En procés</option>
                                                    <option>Finalitzat</option>
                                                    <option>Contactat</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection