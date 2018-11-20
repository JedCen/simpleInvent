<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                        Lista de Proveedores
                        </div>
                        <div class="float-right">
                          <button @click="initAddProveedor()" class="btn btn-secondary btn-sm">
                              <i class="icon ion-person-add"></i> Nuevo Proveedor
                          </button>
                        </div>
                    </div>
                    <div class="card-body" v-cloak>
                        <div class="float-right">
                          <form class="form-inline">
                            <label class="sr-only" for="inlineFormInputGroupUsername2">Buscar</label>
                            <div class="input-group mb-2 mr-sm-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="icon ion-search">  </i></div>
                              </div>
                              <input type="text" class="form-control" id="inlineFormInputGroupUsername2" v-model="search" placeholder="Buscar por nombre">
                              <button type="button" class="btn btn-default" @click.prevent="resetSearch">Reset</button>
                            </div>
                          </form>
                        </div>
                        <table class="table table-bordered table-striped" v-if="proveedor.length > 0">
                            <tbody>
                                <tr>
                                    <th>IDº</th>
                                    <th>Nombre Completo</th>
                                    <th>RFC</th>
                                    <th>Dirección</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Accion</th>
                                </tr>
                                <tr v-for="(proveedor, index) in filteredProveedor" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        {{ proveedor.name }} {{ proveedor.lastname }}
                                    </td>
                                    <td>{{proveedor.rfc}}</td>
                                    <td>
                                        {{ proveedor.address1 }}
                                    </td>
                                    <td>{{proveedor.phone1}}</td>
                                    <td>{{proveedor.email1}}</td>
                                    <td>
                                        <button @click="initUpdate(index)" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button>

                                        <button @click="deleteProveedor(index)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
                                        <span>Atras</span>
                                    </a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" v-bind:class="[ page == isActived ? 'active' : '']">
                                     <a class="page-link" href="#" @click.prevent="changePage(page)">
                                        {{ page }}
                                    </a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
                                        <span>Siguiente</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_proveedor_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Nuevo Proveedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nombre:</label>
                            <input type="text" placeholder="Nombre" class="form-control"
                                   v-model="proveedor.name">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellido:</label>
                            <input type="text" placeholder="Apellido" class="form-control"
                                   v-model="proveedor.lastname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>RFC:</label>
                            <input type="text" placeholder="RFC" class="form-control"
                                   v-model="proveedor.rfc">
                        </div>
                    </div>
                        <div class="form-group">
                            <label>Dirección:</label>
                            <input type="text" placeholder="Dirección" class="form-control"
                                   v-model="proveedor.address1">
                        </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Telefono:</label>
                            <input type="phone" placeholder="Nº Telefono" class="form-control" v-model="proveedor.phone1">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Dirección Email" v-model="proveedor.email1">
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" @click="createProveedor" class="btn btn-primary">Enviar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade modal-info" tabindex="-1" role="dialog" id="update_proveedor_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Actualizar datos proveedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" placeholder="Nombre" class="form-control"
                                   v-model="update_proveedor.name">
                        </div>
                        <div class="form-group">
                            <label>Apellido:</label>
                            <input type="text" placeholder="Apellido" class="form-control"
                                   v-model="update_proveedor.lastname">
                        </div>
                        <div class="form-group">
                            <label>RFC:</label>
                            <input type="text" placeholder="RFC" class="form-control"
                                   v-model="update_proveedor.rfc">
                        </div>
                        <div class="form-group">
                            <label>Dirección:</label>
                            <input type="text" placeholder="Dirección" class="form-control"
                                   v-model="update_proveedor.address1">
                        </div>
                        <div class="form-group">
                            <label>Telefono:</label>
                            <input type="phone" placeholder="Nº Telefono" class="form-control" v-model="update_proveedor.phone1">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Dirección Email" v-model="update_proveedor.email1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click="readPosts" data-dismiss="modal">Cancelar</button>
                        <button type="button" @click="updateProveedor" class="btn btn-primary">Actualizar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</template>

<script>
export default {
  data() {
    return {
      proveedor: {
        name: "",
        lastname: "",
        rfc: "",
        address1: "",
        phone1: "",
        email1: "",
        conection: ""
      },
      search: "",
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 2,
      errors: [],
      proveedor: [],
      update_proveedor: {}
    };
  },
  mounted() {
    this.readPosts();
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
    filteredProveedor: function() {
      return this.proveedor.filter(proveedor => {
        return proveedor.name.match(this.search);
      });
    }
  },
  methods: {
    initAddProveedor() {
      this.errors = [];
      $("#add_proveedor_model").modal("show");
    },
    createProveedor() {
      axios
        .post("/proveedor", {
          name: this.proveedor.name,
          lastname: this.proveedor.lastname,
          rfc: this.proveedor.rfc,
          address1: this.proveedor.address1,
          phone1: this.proveedor.phone1,
          email1: this.proveedor.email1
        })
        .then(response => {
          this.reset();

          $("#add_proveedor_model").modal("hide");
          toastr.success("Cliente: se agrego correctamente!");
          this.readPosts();
        })
        .catch(error => {
          this.errors = [];
          if (error.response.data.errors.name) {
            toastr.warning(error.response.data.errors.name[0]);
          }

          if (error.response.data.errors.lastname) {
            toastr.warning(error.response.data.errors.lastname[0]);
          }

          if (error.response.data.errors.rfc) {
            toastr.warning(error.response.data.errors.rfc[0]);
          }

          if (error.response.data.errors.address1) {
            toastr.warning(error.response.data.errors.address1[0]);
          }

          if (error.response.data.errors.phone1) {
            toastr.warning(error.response.data.errors.phone1[0]);
          }

          if (error.response.data.errors.email1) {
            toastr.warning(error.response.data.errors.email1[0]);
          }
        });
    },
    reset() {
      this.proveedor.name = "";
      this.proveedor.lastname = "";
      this.proveedor.rfc = "";
      this.proveedor.address1 = "";
      this.proveedor.phone1 = "";
      this.proveedor.email1 = "";
    },
    readPosts(page) {
      axios
        .get("/proveedoreslist?page=" + page)
        .then(response => {
          this.proveedor = response.data.proveedor.data;
          this.pagination = response.data.pagination;
        })
        .catch(error => {
          this.errors = [];
          this.errors.push("Sin acceso a servicio");
        });
    },
    initUpdate(index) {
      this.errors = [];
      $("#update_proveedor_model").modal("show");
      this.update_proveedor = this.proveedor[index];
    },
    updateProveedor() {
      axios
        .patch("/proveedor/" + this.update_proveedor.id, {
          name: this.update_proveedor.name,
          lastname: this.update_proveedor.lastname,
          rfc: this.update_proveedor.rfc,
          address1: this.update_proveedor.address1,
          phone1: this.update_proveedor.phone1,
          email1: this.update_proveedor.email1
        })
        .then(response => {
          $("#update_proveedor_model").modal("hide");
          toastr.info(
            "Cliente: " +
              this.update_proveedor.name +
              ", se modifico correctamente!"
          );
        })
        .catch(error => {
          this.errors = [];
          if (error.response.data.errors.name) {
            toastr.warning(error.response.data.errors.name[0]);
          }

          if (error.response.data.errors.lastname) {
            toastr.warning(error.response.data.errors.lastname[0]);
          }

          if (error.response.data.errors.rfc) {
            toastr.warning(error.response.data.errors.rfc[0]);
          }

          if (error.response.data.errors.address1) {
            toastr.warning(error.response.data.errors.address1[0]);
          }

          if (error.response.data.errors.phone1) {
            toastr.warning(error.response.data.errors.phone1[0]);
          }

          if (error.response.data.errors.email1) {
            toastr.warning(error.response.data.errors.email1[0]);
          }
        });
    },
    deleteProveedor(index) {
      let conf = confirm("Desea eliminar el cliente ?");
      if (conf === true) {
        axios
          .delete("/proveedor/" + this.proveedor[index].id)
          .then(response => {
            this.proveedor.splice(index, 1);
            toastr.success("Cliente: se Elimino correctamente!");
          })
          .catch(error => {});
      }
    },
    changePage(page) {
      this.pagination.current_page = page;
      this.readPosts(page);
    },
    resetSearch() {
      this.search = "";
    }
  }
};
</script>

