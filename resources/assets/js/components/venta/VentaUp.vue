<template>
<div>
	<div class="well">
        <div class="row">
            <div class="col-6 col-sm-6">
                <input name="provId" type="hidden" v-model="receiversProv.prov_id">
                  <input id="proveedor" class="form-control" type="text" placeholder="Nombre del Cliente..." v-model="receiversProv.name">
            </div>
            <div class="col-2 col-sm-2">
                <input class="form-control" type="text" placeholder="RFC" readonly  disabled v-model="receiversProv.rfc">
            </div>
            <div class="col-4 col-sm-4">
                <input class="form-control" type="text" placeholder="Dirección" readonly  disabled v-model="receiversProv.address1">
            </div>
        </div>
    </div>

    <div class="well">
        <div class="row">
            <div class="col-5 col-sm-5">
                <input type="hidden" v-model="product_id">
                <input id="producto" class="form-control" type="text" placeholder="Nombre del producto" v-model="receiversProd.name">
            </div>
            <div class="col-2 col-sm-2">
                <input class="form-control" type="text" placeholder="Cantidad" v-model="quantity">
            </div>
            <div class="col-2 col-sm-2">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Stock</span>
                  </div>
                    <input class="form-control" type="text" aria-label="Stock" placeholder="Stock" readonly v-model="stock">
                </div>
            </div>
            <div class="col-2 col-sm-2">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
              <input type="text" class="form-control" aria-label="Precio" readonly v-model="receiversProd.price">
            </div>
            </div>
            <div class="col-1 col-sm-1">
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
                <button  class="btn btn-danger btn-xs btn-block" v-on:click="removeProductFromDetail">X</button>
            </td>
            <td > {{ item.name }} </td>
            <td class="text-right"> {{ item.quantity }} </td>
            <td class="text-right">{{ item.price }}</td>
            <td class="text-right">{{ item.total }}</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="text-right"><b>IVA</b></td>
            <td class="text-right">$ {{iva}}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Sub Total</b></td>
            <td class="text-right">$ {{subTotal}}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Total</b></td>
            <td class="text-right">$ {{total}}</td>
        </tr>
        </tfoot>
    </table>
    <button class="botton-guardar" v-if="detail.length > 0 && proveedor_id > 0" @click="newAbastecer">
        Guardar
    </button>
    <button class="btn btn-danger btn-app"  v-if="detail.length > 0 && proveedor_id > 0" @click.prevent="resetDatos">Cancelar</button>
</div>

</template>

<script>
import easyAutocomplete from "easy-autocomplete";
export default {
  data() {
    return {
      errors: [],
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
        this.detail.push({
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
    },
    calculate() {
      const vm = this;
      var total = 0;

      vm.detail.forEach(function(e) {
        total += e.total;
      });

      vm.total = total;
      vm.subTotal = parseFloat(total * 0.84);
      vm.iva = parseFloat(total * 0.16);
    },
    removeProductFromDetail(e) {
      var item = e.item,
        index = this.detail.indexOf(item);
      toastr.warning("Se elimino correctamente!", "Atención");
      this.detail.splice(index, 1);
      this.calculate();
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
            }
          }
        };

        prove.easyAutocomplete(options);
      });
    },
    productAutocomplete() {
      axios.get("/searchproduct").then(response => {
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
    },
    addReceiverProd() {
      var e = $("#producto").getSelectedItemData();
      this.product_id = e.id;
      this.receiversProd.name = e.name;
      this.stock = e.stock;
      this.receiversProd.price = e.price;
      this.receiversProd.push(e);
    }
  }
};
</script>
<style>
.botton-guardar {
  border: 1px solid #c9ae34;
  color: #705d07;
  border-radius: 3px 3px 3px 3px;
  -webkit-border-radius: 3px 3px 3px 3px;
  -moz-border-radius: 3px 3px 3px 3px;
  font-family: Trebuchet MS;
  width: auto;
  height: auto;
  font-size: 16px;
  padding: 9px 65px;
  box-shadow: inset 0 1px 0 0 #fff6ce, inset 0 -1px 0 0 #e3c852,
    inset 0 0 0 1px #fce88d, 0 2px 4px 0 #d4d4d4;
  -moz-box-shadow: inset 0 1px 0 0 #fff6ce, inset 0 -1px 0 0 #e3c852,
    inset 0 0 0 1px #fce88d, 0 2px 4px 0 #d4d4d4;
  -webkit-box-shadow: inset 0 1px 0 0 #fff6ce, inset 0 -1px 0 0 #e3c852,
    inset 0 0 0 1px #fce88d, 0 2px 4px 0 #d4d4d4;
  text-shadow: 0 1px 0 #ffffff;
  background-image: linear-gradient(to left, #fce374, #fcdf5b);
  background-color: #fce374;
  float: right;
}
.botton-guardar:hover,
.botton-guardar:active {
  border: 1px solid #967d09;
  color: #705d07;
  box-shadow: inset 0 1px 0 0 #fff6ce, inset 0 -1px 0 0 #e3c852,
    inset 0 0 0 1px #fce88d;
  -moz-box-shadow: inset 0 1px 0 0 #fff6ce, inset 0 -1px 0 0 #e3c852,
    inset 0 0 0 1px #fce88d;
  -webkit-box-shadow: inset 0 1px 0 0 #fff6ce, inset 0 -1px 0 0 #e3c852,
    inset 0 0 0 1px #fce88d;
  background-color: #fcdf5b;
}
</style>

