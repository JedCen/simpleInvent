<template>
<div>
	<div class="well well-sm">
        <div class="row">
            <div class="col-xs-6">
                  <input id="proveedor" class="form-control typeahead" type="text" placeholder="Nombre del proveedor...">
            </div>
            <div class="col-xs-2">
                <input class="form-control" type="text" placeholder="RFC" v-model="proveedor.rfc" readonly  disabled>
            </div>
            <div class="col-xs-4">
                <input class="form-control" type="text" placeholder="Dirección" readonly  disabled/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-5">
            <input class="form-control" type="text" placeholder="Nombre del producto" />
        </div>
        <div class="col-xs-2">
            <input class="form-control" type="text" placeholder="Cantidad" />
        </div>
        <div class="col-xs-2">
            <div class="input-group">
                <span class="input-group-addon">Stock</span>
                <input class="form-control" type="text" placeholder="Stock" readonly />
            </div>
        </div>
        <div class="col-xs-2">
            <div class="input-group">
                <span class="input-group-addon" >$</span>
                <input class="form-control" type="text" placeholder="Precio"  readonly />
            </div>
        </div>
        <div class="col-xs-1">
            <button  class="btn btn-primary form-contro" id="btn-agregar">
                <i class="glyphicon glyphicon-plus"></i>
            </button>
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
        <tr>
            <td>
                <button  class="btn btn-danger btn-xs btn-block">X</button>
            </td>
            <td>cocca</td>
            <td class="text-right">2</td>
            <td class="text-right">$ 10</td>
            <td class="text-right">$ 20</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="text-right"><b>IVA</b></td>
            <td class="text-right">$ 12</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Sub Total</b></td>
            <td class="text-right">$ 11</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Total</b></td>
            <td class="text-right">$ 11</td>
        </tr>
        </tfoot>
    </table>

    <button class="btn btn-default btn-lg btn-block">
        Guardar
    </button>
</div>
</template>

<script>
import easyAutocomplete from "easy-autocomplete";
export default {
  data() {
    return {
      proveedor: {
        cliente_id: "",
        rfc: ""
      },
      stock: [],
      errors: [],
      proveedor: [],
      q: ""
    };
  },
  mounted: function() {
    this.proveedorAutocomplete();
  },
  methods: {
    proveedorAutocomplete() {
      axios
        .get("/searchproovedor", { params: { q: this.q } })
        .then(response => {
          this.proveedor = response.data.proveedor;

          const vm = this;
          var prove = $("#proveedor");

          var options = {
            data: this.proveedor,
            getValue: "name",
            list: {
              match: {
                enabled: true
              },
              onClickEvent: function() {
                vm.addReceiver();
              }
            }
          };

          prove.easyAutocomplete(options);
        });
    },
    addReceiver() {
      var name = $("#proveedor").getSelectedItemData().name;
      this.receivers.push(name);
      this.rfc = name.rfc;
    }
  }
};
</script>
