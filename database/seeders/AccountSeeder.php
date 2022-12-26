<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;


class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $accounts = array(
            array('id' => '1', 'name' => 'ASSETS', 'usage' => 'assets', 'account_id' => NULL, 'level' => '1', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '2', 'name' => 'LIABILITIES', 'usage' => 'liabilities', 'account_id' => NULL, 'level' => '1', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '3', 'name' => 'INCOME', 'usage' => 'income', 'account_id' => NULL, 'level' => '1', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '4', 'name' => 'EXPENSES', 'usage' => 'expenses', 'account_id' => NULL, 'level' => '1', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '5', 'name' => 'EQUITIES & SHARE CAPITAL', 'usage' => 'equity', 'account_id' => NULL, 'level' => '1', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '11', 'name' => 'Current Assets', 'usage' => NULL, 'account_id' => '1', 'level' => '2', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '12', 'name' => 'Fixed Assets', 'usage' => NULL, 'account_id' => '1', 'level' => '2', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '21', 'name' => 'Current Liabilities', 'usage' => NULL, 'account_id' => '2', 'level' => '2', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '22', 'name' => 'Accrued Liabilities', 'usage' => NULL, 'account_id' => '2', 'level' => '2', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '31', 'name' => 'SALES', 'usage' => NULL, 'account_id' => '3', 'level' => '2', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '41', 'name' => 'Direct Expenses', 'usage' => NULL, 'account_id' => '4', 'level' => '2', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '42', 'name' => 'Indirect Expenses', 'usage' => NULL, 'account_id' => '4', 'level' => '2', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '51', 'name' => 'Paid Up Capital', 'usage' => NULL, 'account_id' => '5', 'level' => '2', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '52', 'name' => 'Partners Current Accounts', 'usage' => NULL, 'account_id' => '5', 'level' => '2', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '111', 'name' => 'Cash', 'usage' => NULL, 'account_id' => '11', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '112', 'name' => 'Bank', 'usage' => NULL, 'account_id' => '11', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '113', 'name' => 'Accounts Receivable', 'usage' => NULL, 'account_id' => '11', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '114', 'name' => 'Staff Receivables', 'usage' => NULL, 'account_id' => '11', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '116', 'name' => 'Inventories', 'usage' => NULL, 'account_id' => '11', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '121', 'name' => 'Fixed Asset', 'usage' => NULL, 'account_id' => '12', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '122', 'name' => 'Accumulated Depreciation', 'usage' => NULL, 'account_id' => '12', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '211', 'name' => 'Accounts payable', 'usage' => NULL, 'account_id' => '21', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '221', 'name' => 'Accrued Salary', 'usage' => NULL, 'account_id' => '22', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '311', 'name' => 'Sales1', 'usage' => NULL, 'account_id' => '31', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '411', 'name' => 'Direct Expenses', 'usage' => NULL, 'account_id' => '41', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '421', 'name' => 'Personnel Expenses', 'usage' => NULL, 'account_id' => '42', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '422', 'name' => 'General and Administration Expenses', 'usage' => NULL, 'account_id' => '42', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '423', 'name' => 'Operating expenses', 'usage' => NULL, 'account_id' => '42', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '424', 'name' => 'Financial Charges', 'usage' => NULL, 'account_id' => '42', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '425', 'name' => 'Depreciation and Amortization Expenses', 'usage' => NULL, 'account_id' => '42', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '511', 'name' => 'Paid Up Capital', 'usage' => NULL, 'account_id' => '51', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '521', 'name' => 'Partners Current Accounts', 'usage' => NULL, 'account_id' => '52', 'level' => '3', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '111022', 'name' => 'Petty Cash', 'usage' => NULL, 'account_id' => '111', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:27'),
            array('id' => '111027', 'name' => 'Cash Sales', 'usage' => 'cash', 'account_id' => '111', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:57'),
            array('id' => '112001', 'name' => 'Gulf Bank', 'usage' => 'bank', 'account_id' => '112', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:13:21'),
            array('id' => '113002', 'name' => 'Knet Receivables', 'usage' => NULL, 'account_id' => '113', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-23 09:37:12'),
            array('id' => '114001', 'name' => 'Staff Loan', 'usage' => NULL, 'account_id' => '114', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '116001', 'name' => 'Inventory', 'usage' => NULL, 'account_id' => '116', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '121001', 'name' => 'Specialised Equipments', 'usage' => NULL, 'account_id' => '121', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '121005', 'name' => 'Vehicle', 'usage' => NULL, 'account_id' => '121', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:16:02'),
            array('id' => '122001', 'name' => 'Accumulated Depreciation - Specialised Equipments', 'usage' => NULL, 'account_id' => '122', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:16:41'),
            array('id' => '122005', 'name' => 'Accumulated Depreciation - Vehicle', 'usage' => NULL, 'account_id' => '122', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:16:34'),
            array('id' => '221001', 'name' => 'Accrued Salary', 'usage' => NULL, 'account_id' => '221', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:19:32'),
            array('id' => '221002', 'name' => 'Rent payable', 'usage' => NULL, 'account_id' => '221', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '311001', 'name' => 'Sales', 'usage' => 'sales', 'account_id' => '311', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:44:53'),
            array('id' => '411002', 'name' => 'Cost Of Sales - Consumables', 'usage' => 'cost_of_sales', 'account_id' => '411', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:43:38'),
            array('id' => '421001', 'name' => 'Employees related expense', 'usage' => NULL, 'account_id' => '421', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '421002', 'name' => 'Wages and Salaries Expenses', 'usage' => NULL, 'account_id' => '421', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '421003', 'name' => 'Staff Visa Iqama Clearance', 'usage' => NULL, 'account_id' => '421', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '421004', 'name' => 'OTHER ALLOWANCE', 'usage' => NULL, 'account_id' => '421', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '422001', 'name' => 'Printing and Stationery', 'usage' => NULL, 'account_id' => '422', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '422002', 'name' => 'Mobile and Telephone Expenses', 'usage' => NULL, 'account_id' => '422', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '422003', 'name' => 'Audit, Legal and Professional Expenses', 'usage' => NULL, 'account_id' => '422', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '422004', 'name' => 'Miscellaneous Expenses', 'usage' => NULL, 'account_id' => '422', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '422005', 'name' => 'Gov Licensing and formalities Expenses', 'usage' => NULL, 'account_id' => '422', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '423001', 'name' => 'Renewal Fees And Installation Expenses', 'usage' => NULL, 'account_id' => '423', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '423002', 'name' => 'Utilities Expenses- Water, Electricity and Gas', 'usage' => NULL, 'account_id' => '423', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '423003', 'name' => 'Repairs and Maintenance', 'usage' => NULL, 'account_id' => '423', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '423004', 'name' => 'Cleaning Expenses', 'usage' => NULL, 'account_id' => '423', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '423005', 'name' => 'Rent Expenses', 'usage' => NULL, 'account_id' => '423', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '423007', 'name' => 'Uniforms Expenses', 'usage' => NULL, 'account_id' => '423', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '423008', 'name' => 'Fuel Expenses', 'usage' => NULL, 'account_id' => '423', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '423010', 'name' => 'Cars Repairs and maintenance Expenses', 'usage' => NULL, 'account_id' => '423', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '423011', 'name' => 'Transporation expenses', 'usage' => NULL, 'account_id' => '423', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '424001', 'name' => 'Bank Charges', 'usage' => NULL, 'account_id' => '424', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:12:16'),
            array('id' => '425001', 'name' => 'Depreciation - Specialised Equipments', 'usage' => NULL, 'account_id' => '425', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:53:28'),
            array('id' => '425002', 'name' => 'Depreciation - Vehicle', 'usage' => NULL, 'account_id' => '425', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:23:22'),
            array('id' => '511001', 'name' => 'Abd Al Rahman - Capital', 'usage' => NULL, 'account_id' => '511', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:29:22'),
            array('id' => '521001', 'name' => 'Abd Al Rahman - Current Account', 'usage' => NULL, 'account_id' => '521', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:12:16', 'updated_at' => '2022-12-22 16:29:58'),
            array('id' => '521002', 'name' => 'Ghaseel Receivables', 'usage' => NULL, 'account_id' => '113', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:14:33', 'updated_at' => '2022-12-23 09:37:18'),
            array('id' => '521003', 'name' => 'Just Clean Receivables', 'usage' => NULL, 'account_id' => '113', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:14:46', 'updated_at' => '2022-12-23 09:37:24'),
            array('id' => '521004', 'name' => 'Hazem - Capital', 'usage' => NULL, 'account_id' => '511', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:29:36', 'updated_at' => '2022-12-22 16:29:36'),
            array('id' => '521005', 'name' => 'Hazem - Current Account', 'usage' => NULL, 'account_id' => '521', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:30:13', 'updated_at' => '2022-12-22 16:30:13'),
            array('id' => '521006', 'name' => 'Ghaseel Commission', 'usage' => NULL, 'account_id' => '424', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:45:34', 'updated_at' => '2022-12-22 16:45:34'),
            array('id' => '521007', 'name' => 'Just Clean Commission', 'usage' => NULL, 'account_id' => '424', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-22 16:45:59', 'updated_at' => '2022-12-22 16:45:59'),
            array('id' => '521008', 'name' => 'Customer Receivables', 'usage' => NULL, 'account_id' => '113', 'level' => '4', 'active' => '1', 'created_at' => '2022-12-23 09:36:39', 'updated_at' => '2022-12-23 09:36:39')
        );



    Account::insert($accounts);

}}
