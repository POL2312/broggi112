<template lang="">
        <div class="container main-container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light ">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#identificacio_trucada">Identificació de la Trucada</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#nota_comuna">Nota Comuna</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#localitzacio_emergencia">Localització emergència</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#tipificacio_emergencia">Tipificació emergència</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#agencies">Agències</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



        <div class="container mt-3 ">
            <div class="row">
                <div class="col-md-8 content-container" >
                    <form>
                        <section id="identificacio_trucada">
                            <h2 >Identificació de la Trucada</h2>
                            <div class="mb-3">
                                <input type="tel" class="form-control" name="numTel" id="numTel" placeholder="Nº Telèfon" required autofocus>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <select class="form-select" v-model="selectedProvinciaIdentiTrucada" @change="fetchComarques" required>
                                        <option v-if="carregant" value="" disabled selected>Carregant...</option>
                                        <option v-else value="" disabled selected>Provincia</option>
                                        <option v-for="provincia in provincies" :key="provincia.id" :value="provincia.id">
                                            {{ provincia.nom }}
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <select class="form-select" v-model="selectedComarcaIdentiTrucada" @change="fetchMunicipis" :disabled="!selectedProvincia" required>
                                        <option value="" disabled selected>Comarca</option>
                                        <option v-for="comarca in comarques" :key="comarca.id" :value="comarca.id">
                                            {{ comarca.nom }}
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <select class="form-select" v-model="selectedMunicipiIdentiTrucada" :disabled="!selectedComarca" required>
                                        <option value="" disabled selected>Municipi</option>
                                        <option v-for="municipi in municipis" :key="municipi.id" :value="municipi.id">
                                            {{ municipi.nom }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <input type="text" class="form-control" name="adreça" id="adreça" placeholder="Adreça" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="procedencia" id="procedencia" placeholder="Procedencia" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="Antecedents" id="Antecedents" placeholder="Antecedents del telèfon" required>
                                </div>
                            </div>
                        </section>


                        <section class="mt-2" id="nota_comuna">
                            <h2>Nota Comuna</h2>
                            <div class="form-group">
                                <textarea class="form-control" rows="7" name="descripcion" placeholder="Nom y cognom del trucant, relació de l’alertant amb l’incident, telefon de contacte, descripcio del fet." required></textarea>
                            </div>
                        </section>

                        <section class="mt-3" id="localitzacio_emergencia">
                            <h2>Localització emergència</h2>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="foraDeCatalunya" @change="toggleForaDeCatalunya">
                                <label class="form-check-label" for="foraDeCatalunya">
                                    Fora de Catalunya
                                </label>
                            </div>

                            <div class="row" v-if="!foraDeCatalunya">

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <select class="form-select" v-model="selectedProvincia" @change="fetchComarques" required>
                                            <option v-if="carregant" value="" disabled selected>Cargando...</option>
                                            <option v-else value="" disabled selected>Provincia</option>
                                            <option v-for="provincia in provincies" :key="provincia.id" :value="provincia.id">
                                                {{ provincia.nom }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <select class="form-select" v-model="selectedComarca" @change="fetchMunicipis" :disabled="!selectedProvincia" required>
                                            <option value="" disabled selected>Comarca</option>
                                            <option v-for="comarca in comarques" :key="comarca.id" :value="comarca.id">
                                                {{ comarca.nom }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <select class="form-select" v-model="selectedMunicipi" :disabled="!selectedComarca" required>
                                            <option value="" disabled selected>Municipi</option>
                                            <option v-for="municipi in municipis" :key="municipi.id" :value="municipi.id">
                                                {{ municipi.nom }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <select class="form-select" name="tipusLocalitzacio" required>
                                            <option value="" disabled selected>Tipus de localització</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row" v-else>
                                <div class="col-12 mb-3">
                                    <select class="form-select" name="provinciaFora" required>
                                        <option value="" disabled selected>Provincia</option>

                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <textarea class="form-control" name="mesInformacio" id="mesInformacio" placeholder="Més informació sobre la localització"></textarea>
                                </div>
                            </div>
                        </section>


                        <section class="mt-2" id="tipificacio_emergencia">
                            <h2>Tipificació emergència</h2>

                            <div class="row">
                                <div class="col">
                                    <select class="form-select" name="tipus_incident" required>
                                        <option value="" disabled selected>Tipus d'incident</option>
                                        <!-- Opciones de tipos de incidentes aquí -->
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-select" name="incident" required>
                                        <option value="" disabled selected>Incident</option>
                                        <!-- Opciones de incidentes aquí -->
                                    </select>
                                </div>
                            </div>

                            <p class="mt-3">INCIDENT SELECCIONAT: <span id="incident_seleccionat">N/A</span></p>
                            <p>DEFINICIÓ INCIDENT: <span id="definicio_incident">N/A</span></p>
                            <p>INSTRUCCIONS INCIDENT: Aquí les instruccions</p>
                        </section>


                        <section class="mt-2" id="agencies">
                            <h2>Agències</h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan metus id mi aliquet, ac accumsan neque fringilla. Aliquam erat volutpat. Duis in nisi eget lectus semper sodales. Donec pulvinar aliquam nunc, vitae pellentesque risus fermentum volutpat. Nunc nibh orci, fermentum et dapibus non, iaculis quis libero. Sed convallis hendrerit convallis. Pellentesque tortor nibh, molestie et felis sit amet, cursus consequat ligula. Nullam dolor ipsum, dictum et tempor pulvinar, lobortis ut tellus. Aliquam consectetur erat ut nunc imperdiet rhoncus. Praesent eget iaculis purus. Sed rutrum erat tempus, scelerisque risus et, fermentum quam. Duis et justo eget augue feugiat eleifend quis eget neque. Proin et lorem imperdiet, viverra augue ut, posuere nibh. Fusce faucibus, mi quis faucibus gravida, urna metus convallis purus, sed lacinia dui arcu sed leo. Mauris nec ultricies elit. In commodo erat eu erat ultrices suscipit. Nullam id elit ligula. Mauris sed commodo massa. Vivamus maximus odio nisi, id hendrerit magna accumsan suscipit. Aliquam tristique lectus quis dolor molestie molestie. Maecenas sed vehicula ex. Morbi et mollis urna.
                            </p>
                        </section>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>

                </div>
                <div class="ms-5 col-md-3 content-container">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan metus id mi aliquet, ac accumsan neque fringilla.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            foraDeCatalunya: false,
            provincies: [],
            comarques: [],
            municipis: [],
            selectedProvinciaIdentiTrucada: "",
            selectedComarcaIdentiTrucada: "",
            selectedMunicipiIdentiTrucada: "",
            selectedProvincia: "",
            selectedComarca: "",
            selectedMunicipi: "",
            carregant: true,
        };
    },
    created() {
        this.fetchProvincies();
    },
    methods: {
        toggleForaDeCatalunya() {
            this.foraDeCatalunya = !this.foraDeCatalunya;
        },
        fetchProvincies() {
            axios
                .get("/api/provincies")
                .then((response) => {
                    this.provincies = response.data;
                    this.carregant = false;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        fetchComarques() {
            axios
                .get(`/api/provincies/${this.selectedProvincia}/comarques`)
                .then((response) => {
                    this.comarques = response.data;
                    this.selectedComarca = "";
                    this.municipis = [];
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        fetchMunicipis() {
            axios
                .get(`/api/comarques/${this.selectedComarca}/municipis`)
                .then((response) => {
                    this.municipis = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>


<style>
.main-container {
    margin-top: 50px;
    margin-bottom: 20px;
}

.content-container {
    height: calc(85vh - 100px);
    overflow-y: scroll;
}
</style>
