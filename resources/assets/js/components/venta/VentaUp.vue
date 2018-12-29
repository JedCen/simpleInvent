<template>
<div>
	<div class="well">
        <div class="row">
            <div class="col-sm-6">
                <input name="provId" type="hidden" v-model="receiversProv.prov_id">
                  <input id="proveedor" class="form-control" type="text" placeholder="Nombre del Cliente..." v-model="receiversProv.name">
            </div>
            <div class="col-sm-2">
                <input class="form-control" type="text" placeholder="RFC" readonly  disabled v-model="receiversProv.rfc">
            </div>
            <div class="col-sm-4">
                <input class="form-control" type="text" placeholder="Dirección" readonly  disabled v-model="receiversProv.address1">
            </div>
        </div>
    </div>

    <div class="well">
        <div class="row">
            <div class="col-sm-5">
                <input type="hidden" v-model="product_id">
                <input id="producto" ref="producto" class="form-control" type="text" placeholder="Nombre del producto" v-model="receiversProd.name">
            </div>
            <div class="col-sm-2">
                <input class="form-control" type="text" ref="cantidad" placeholder="Cantidad" v-model="quantity">
            </div>
            <div class="col-sm-2">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Stock</span>
                  </div>
                    <input class="form-control" type="text" aria-label="Stock" placeholder="Stock" readonly v-model="stock">
                </div>
            </div>
            <div class="col-sm-2">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">{{ configs.symbol }}</span>
              </div>
              <input type="text" class="form-control" aria-label="Precio" readonly v-model="receiversProd.price">
            </div>
            </div>
            <div class="col-sm-1">
                <button  class="btn btn-primary form-contro" id="btn-agregar" v-if="quantity > 0 && receiversProd.name != null" v-on:click="addProducToDetail">
                    <i class="fa fa-plus"></i>
                </button>
                <button  class="btn btn-primary form-contro" id="btn-agregar" v-else-if="quantity < 0 && receiversProd.name == null">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
    <hr />
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width:40px;"></th>
            <th>Producto</th>
            <th style="width:100px;">Cantidad</th>
            <th style="width:100px;">P.U</th>
            <th style="width:100px;">Total</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in detail" :key="index">
            <td>
                <button  class="btn btn-danger btn-sm" v-on:click="removeProductFromDetail"><i class="fas fa-eraser"></i></button>
            </td>
            <td > {{ item.name }} </td>
            <td class="text-right"> {{ item.quantity }} </td>
            <td class="text-right">{{ item.price }}</td>
            <td class="text-right">{{ item.total }}</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <td colspan="4" class="text-right"><b>Sub Total</b></td>
          <td class="text-right">{{ configs.symbol }} {{subTotal}}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>{{ configs.name_imp }}</b></td>
            <td class="text-right">{{ configs.symbol }} {{iva}}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Total</b></td>
            <td class="text-right">{{ configs.symbol }} {{total}}</td>
        </tr>
        </tfoot>
    </table>
    </div>
      <div class="col-sm-3 float-left">
        <button class="btn btn-danger btn-block"  v-if="detail.length > 0 && proveedor_id > 0" @click.prevent="resetDatos">
          <i class="fas fa-exclamation-triangle"></i> Cancelar
        </button>
      </div>
      <div class="col-sm-3 float-right">
        <button class="btn btn-warning btn-block" v-if="detail.length > 0 && proveedor_id > 0" @click="newAbastecer">
           <i class="far fa-save"></i> Guardar 
        </button>
      </div>
</div>

</template>

<script>
import easyAutocomplete from "easy-autocomplete";
export default {
  data() {
    return {
      errors: [],
      configs: [],
      proveedor: [],
      producto: [],
      receiversProv: [],
      receiversProd: [],
      detail: [],
      proveedor_id: 0,
      product_id: 0,
      stock: null,
      quantity: "",
      iva: "",
      subTotal: "",
      total: ""
    };
  },
  mounted: function() {
    this.proveedorAutocomplete();
    this.productAutocomplete();
    this.ConfigurationSystem();
    if (sessionStorage.getItem("_Prov2")) {
      try {
        this.proveedor_id = sessionStorage.getItem("_Prov2");
      } catch(e) {
        sessionStorage.removeItem('_Prov2');
      }
    }
    if (sessionStorage.getItem("_NomProv2")) {
      try {
        this.receiversProv.name = sessionStorage.getItem("_NomProv2");
      } catch(e) {
        sessionStorage.removeItem('_NomProv2');
      }
    }
    if (sessionStorage.getItem("_RFC2")) {
      try {
        this.receiversProv.rfc = sessionStorage.getItem("_RFC2");
      } catch(e) {
        sessionStorage.removeItem('_RFC2');
      }
    }
    if (sessionStorage.getItem("_Adress2")) {
      try {
        this.receiversProv.address1 = sessionStorage.getItem("_Adress2");
      } catch(e) {
        sessionStorage.removeItem('_Adress2');
      }
    }
    if (sessionStorage.getItem("_detail2")) {
      try {
        this.detail = JSON.parse(sessionStorage.getItem("_detail2"));
      } catch(e) {
        sessionStorage.removeItem('_detail2');
      }
    }    
    if (sessionStorage.getItem("_Total2")) {
      try {
        this.total = sessionStorage.getItem("_Total2");
      } catch(e) {
        sessionStorage.removeItem('_Total2');
      }
    }
    if (sessionStorage.getItem("_subTotal2")) {
      try {
        this.subTotal = sessionStorage.getItem("_subTotal2");
      } catch(e) {
        sessionStorage.removeItem('_subTotal2');
      }
    }
    if (sessionStorage.getItem("_iva2")) {
      try {
        this.iva = sessionStorage.getItem("_iva2");
      } catch(e) {
        sessionStorage.removeItem('_iva2');
      }
    }
  },
  methods: {
    addProducToDetail() {
      if (this.stock < this.quantity) {
        toastr.error(
          "Error: No es posible agregar",
          "Verificar la Cantidad en Stock"
        );
      } else {
        const vm = this;

        vm.detail.push({
          id: vm.product_id,
          name: vm.receiversProd.name,
          quantity: parseFloat(vm.quantity),
          price: parseFloat(vm.receiversProd.price),
          total: parseFloat(vm.receiversProd.price * vm.quantity)
        });

        vm.receiversProd.id = 0;
        vm.receiversProd.name = "";
        vm.quantity = "";
        vm.receiversProd.price = "";
        vm.stock = "";
        this.calculate();
        toastr.info("Se agrego correctamente!", "Atención");
        vm.$refs.producto.focus();
        this.saveDetails();
      }
    },
    newAbastecer() {
      const vm = this;
      let conf = confirm("Esta correcto la venta ?");
      if (conf === true) {
        axios
          .post("/save", {
            proveedor_id: vm.proveedor_id,
            product_id: vm.product_id,
            iva: vm.iva,
            subTotal: vm.subTotal,
            total: vm.total,
            detail: vm.detail
          })
          .then(response => {
            toastr.success("Venta: Se realizo correctamente", "Atencion");
            this.resetDatos();
            this.sesionRemove();
            window.location.href = '/create'
          })
          .catch(error => {
            console.log(error.response);
          });
      }
    },
    resetDatos() {
      this.proveedor = [];
      this.producto = [];
      this.detail = [];
      this.receiversProv = [];
      this.receiversProd = [];
      this.proveedor_id = 0;
      this.product_id = 0;
      this.quantity = "";
      this.iva = "";
      this.subTotal = "";
      this.total = "";
      this.stock = null;
      this.sesionRemove();
    },
    calculate() {
      const vm = this;
      var total = 0;

      vm.detail.forEach(function(e) {
        total += e.total;
      });

      vm.total = total;
      vm.subTotal = (total/(1 + (vm.configs.val_imp/100))).toFixed(2);
      vm.iva = ((total/(1 + (vm.configs.val_imp/100))) * (vm.configs.val_imp/100)).toFixed(2);
      sessionStorage.setItem('_Total2', vm.total);
      sessionStorage.setItem('_subTotal2', vm.subTotal);
      sessionStorage.setItem('_iva2', vm.iva);
    },
    removeProductFromDetail(e) {
      var item = e.item,
        index = this.detail.indexOf(item);
      toastr.warning("Se elimino correctamente!", "Atención");
      this.detail.splice(index, 1);
      this.calculate();
      this.saveDetails();
    },
    proveedorAutocomplete() {
      axios.get("/searchclient").then(response => {
        this.cliente = response.data.cliente;

        const vm = this;
        var prove = $("#proveedor");

        var options = {
          data: vm.cliente,
          getValue: "name",
          list: {
            match: {
              enabled: true
            },
            onChooseEvent: function() {
              vm.addReceiverProv();
              toastr.info(
                "Cliente: " + vm.receiversProv.name,
                "Se agrego correctamente!"
              );
              vm.$refs.producto.focus();
            }
          }
        };

        prove.easyAutocomplete(options);
      });
    },
    productAutocomplete() {
      axios.get("/searchproductsell").then(response => {
        this.producto = response.data.producto;

        const vm = this;
        var prove = $("#producto");

        var options = {
          data: vm.producto,
          getValue: "name",
          list: {
            match: {
              enabled: true
            },
            onChooseEvent: function() {
              vm.addReceiverProd();
              toastr.info(
                "Producto: " + vm.receiversProd.name,
                "Se agrego correctamente!"
              );
              vm.$refs.cantidad.focus();
            }
          }
        };

        prove.easyAutocomplete(options);
      });
    },
    addReceiverProv() {
      var e = $("#proveedor").getSelectedItemData();
      this.proveedor_id = e.id;
      this.receiversProv.name = e.name;
      this.receiversProv.rfc = e.rfc;
      this.receiversProv.address1 = e.address1;
      this.receiversProv.push(e);
      sessionStorage.setItem('_Prov2', e.id);
      sessionStorage.setItem('_NomProv2', e.name);
      sessionStorage.setItem('_RFC2', e.rfc);
      sessionStorage.setItem('_Adress2', e.address1);
    },
    addReceiverProd() {
      var e = $("#producto").getSelectedItemData();
      this.product_id = e.id;
      this.receiversProd.name = e.name;
      this.stock = e.stock;
      this.receiversProd.price = e.price;
      this.receiversProd.push(e);
    },
    saveDetails() {
      const parsed = JSON.stringify(this.detail);
      sessionStorage.setItem("_detail2", parsed);
    },
    sesionRemove() {
      sessionStorage.removeItem('_Adress2');
      sessionStorage.removeItem('_detail2');
      sessionStorage.removeItem('_iva2');
      sessionStorage.removeItem('_NomProv2');
      sessionStorage.removeItem('_Prov2');
      sessionStorage.removeItem('_RFC2');
      sessionStorage.removeItem('_subTotal2');
      sessionStorage.removeItem('_Total2');
    },
    ConfigurationSystem() {
      axios.get("/config/config").then(response => {
        this.configs = response.data.configs;
      });
    }
  }
};
</script>

