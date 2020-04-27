<template>
    <div>
        <div class="form-group row">
            <label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2"></label>
            <label class="col-lg-2 col-md-3 col-sm-4 mt-sm-2">Khách hàng:</label>
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2">{{ customer.name }}</label>
        </div>
        <div class="form-group row">
            <label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2"></label>
            <label class="col-lg-2 col-md-3 col-sm-4 mt-sm-2">Nợ hiện tại:</label>
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2">{{ formatMoney(customer.customer_debt) }} VNĐ</label>
        </div>
        <div class="form-group row">
            <label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2"></label>
            <label class="col-lg-2 col-md-3 col-sm-4 mt-sm-2">Khách trả
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
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2">{{ formatMoney(customer.customer_debt - totalPayment) }} VNĐ</label>
        </div>
        <div class="form-group row">
            <label class="col-lg-1 col-md-3 col-sm-4 mt-sm-2"></label>
            <label class="col-lg-2 col-md-3 col-sm-4 mt-sm-2">Chi tiết</label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <table class="display table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Thời gian bán</th>
                        <th>Giá trị đơn hàng</th>
                        <th>Đã trả</th>
                        <th>Cần trả</th>
                        <th width="20%">Tiền trả
                            <span class="required-label">*</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(bill, index) in bills" :key="index">
                        <input type="hidden" :name="`bills[${index}][id]`" v-model="bill.id">
                        <td>{{ bill.bill_code }}</td>
                        <td>{{ bill.time_of_sale }}</td>
                        <td>{{ formatMoney(bill.total_money) }} VNĐ</td>
                        <td>{{ formatMoney(bill.paid_by_customer) }} VNĐ</td>
                        <td>{{ formatMoney(bill.total_money - bill.paid_by_customer) }} VNĐ</td>
                        <td>
                            <input type="number" class="form-control" :name="`bills[${index}][paid_by_customer]`" v-model="paidByCustomers[`${index}`]">
                            <div v-if="errors[`bills.${index}.paid_by_customer`]" class="text-danger">{{ errors[`bills.${index}.paid_by_customer`][0] }}</div>
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
            "allBills",
            "customers",
            "svErrors",
            "oldTotalPayment",
        ],
        created() {
            this.bills = JSON.parse(this.allBills) || [];
            this.customer = JSON.parse(this.customers) || {};
            this.errors = JSON.parse(this.svErrors) || [];
            this.totalPayment = JSON.parse(this.oldTotalPayment) || [];
        },
        data() {
            return {
                bills: [],
                customer: {},
                totalPayment: '',
                paidByCustomers: [],
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
