<template>
    <div>
        <div class="form-group row">
            <label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2"></label>
            <label class="col-lg-2 col-md-3 col-sm-4 mt-sm-2">Nhà cung cấp:</label>
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2">{{ supplier.name }}</label>
        </div>
        <div class="form-group row">
            <label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2"></label>
            <label class="col-lg-2 col-md-3 col-sm-4 mt-sm-2">Nợ hiện tại:</label>
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2">{{ formatMoney(supplier.supplier_debt) }} VNĐ</label>
        </div>
        <div class="form-group row">
            <label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2"></label>
            <label class="col-lg-2 col-md-3 col-sm-4 mt-sm-2">Trả cho NCC
                <span class="required-label">*</span>
            </label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input type="number" class="form-control" name="total_payment" v-model="totalPayment">
                <div v-if="errors[`total_payment`]" class="text-danger">{{ errors[`total_payment`][0] }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2"></label>
            <label class="col-lg-2 col-md-3 col-sm-4 mt-sm-2">Nợ sau:</label>
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2">{{ formatMoney(supplier.supplier_debt - totalPayment) }} VNĐ</label>
        </div>
        <div class="form-group row">
            <label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2"></label>
            <label class="col-lg-2 col-md-3 col-sm-4 mt-sm-2">Chi tiết</label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <table class="display table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Mã đơn nhập</th>
                        <th>Thời gian nhập</th>
                        <th>Giá trị đơn nhập</th>
                        <th>Đã trả</th>
                        <th>Cần trả</th>
                        <th width="20%">Tiền trả
                            <span class="required-label">*</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(importOrder, index) in importOrders" :key="index">
                        <input type="hidden" :name="`import_orders[${index}][id]`" v-model="importOrder.id">
                        <td>{{ importOrder.import_order_code }}</td>
                        <td>{{ importOrder.time_of_import }}</td>
                        <td>{{ formatMoney(importOrder.total_money) }} VNĐ</td>
                        <td>{{ formatMoney(importOrder.paid_to_supplier) }} VNĐ</td>
                        <td>{{ formatMoney(importOrder.total_money - importOrder.paid_to_supplier) }} VNĐ</td>
                        <td>
                            <input type="number" class="form-control" :name="`import_orders[${index}][paid_to_supplier]`" v-model="paidToSuppliers[`${index}`]">
                            <div v-if="errors[`import_orders.${index}.paid_to_supplier`]" class="text-danger">{{ errors[`import_orders.${index}.paid_to_supplier`][0] }}</div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: [
            "allImportOrders",
            "suppliers",
            "svErrors",
            "oldTotalPayment",
        ],
        created() {
            this.importOrders = JSON.parse(this.allImportOrders) || [];
            this.supplier = JSON.parse(this.suppliers) || {};
            this.errors = JSON.parse(this.svErrors) || [];
            this.totalPayment = JSON.parse(this.oldTotalPayment) || [];
        },
        data() {
            return {
                importOrders: [],
                supplier: {},
                totalPayment: '',
                paidToSuppliers: [],
                errors: [],
            }
        },
        methods: {
            formatMoney(value) {
                let val = (value / 1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
        }
    }
</script>
