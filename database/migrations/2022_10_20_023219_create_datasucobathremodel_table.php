<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasucobathremodel', function (Blueprint $table) {
            $table->id();
            $table->string('DataSourceID', 255)->nullable();
            $table->string('Token', 255)->nullable();
            $table->string('TokenPassword', 255)->nullable();
            $table->string('EmailAddress', 255)->unique();
            $table->string('Vertical', 255)->nullable();
            $table->string('LeadDate', 255)->nullable();
            $table->string('LeadIPAddress', 255)->nullable();
            $table->string('FirstName', 255)->nullable();
            $table->string('LastName', 255)->nullable();
            $table->string('MailAddress1', 255)->nullable();
            $table->string('CityName', 255)->nullable();
            $table->string('ProvinceStateName', 255)->nullable();
            $table->string('PostalZipCode', 255)->nullable();
            $table->string('PhoneNumber', 255)->nullable();
            $table->string('PhoneSecondary', 255)->nullable();
            $table->string('BirthDate', 255)->nullable();
            $table->string('Gender', 255)->nullable();
            $table->string('Accident', 255)->nullable();
            $table->text('Age')->nullable();
            $table->text('AgeFirstLicensed')->nullable();
            $table->text('AgentFound')->nullable();
            $table->text('AnnualHouseholdIncome')->nullable();
            $table->text('AnnualMileage')->nullable();
            $table->text('AutoInsurance')->nullable();
            $table->text('BankruptcyForeclosure')->nullable();
            $table->text('CarrierName')->nullable();
            $table->text('CarrierType')->nullable();
            $table->text('CashNeeded')->nullable();
            $table->text('CashNeededAmount')->nullable();
            $table->text('CkmAffiliateId')->nullable();
            $table->text('CkmCampaignId')->nullable();
            $table->text('CkmOfferId')->nullable();
            $table->text('CkmSubId1')->nullable();
            $table->text('ComeHomeUrl')->nullable();
            $table->text('CreditRating')->nullable();
            $table->text('CreditRepairRequested')->nullable();
            $table->text('CurrentLender')->nullable();
            $table->text('CurrentLenderOriginal')->nullable();
            $table->text('CurrentLoanAmount')->nullable();
            $table->text('CurrentLoanType')->nullable();
            $table->text('CurrentlyInsured')->nullable();
            $table->text('CurrentMortgageRate')->nullable();
            $table->text('DesiredCoverage')->nullable();
            $table->text('DesiredHvac')->nullable();
            $table->text('DesireHomeownersInsurance')->nullable();
            $table->text('DoesDangerActivities')->nullable();
            $table->text('DoesRequireSR22')->nullable();
            $table->text('DriverVehicleUsageId')->nullable();
            $table->text('Education')->nullable();
            $table->text('ElectricBill')->nullable();
            $table->text('ElectricCompany')->nullable();
            $table->text('EmploymentStatus')->nullable();
            $table->text('EstimatedDebt')->nullable();
            $table->text('EstimatedDownPayment')->nullable();
            $table->text('EstimatedPropertyValue')->nullable();
            $table->text('EstimatedPurchasePrice')->nullable();
            $table->text('ExpirationDate')->nullable();
            $table->text('FacebookId')->nullable();
            $table->text('FinanceCurrentLoanType')->nullable();
            $table->text('FinanceLoanPurpose')->nullable();
            $table->text('FinanceRefinancePurpose')->nullable();
            $table->text('FoundHome')->nullable();
            $table->text('FullName')->nullable();
            $table->text('HasAlarmInstalled')->nullable();
            $table->text('HasConditions')->nullable();
            $table->text('HasHighBMI')->nullable();
            $table->text('HasInsuranceClaims')->nullable();
            $table->text('HasLifeEvent')->nullable();
            $table->text('HasSolar')->nullable();
            $table->text('HomeInsurance')->nullable();
            $table->text('HundredKUse')->nullable();
            $table->text('InfutorAge')->nullable();
            $table->text('InfutorDwellType')->nullable();
            $table->text('InfutorEhi')->nullable();
            $table->text('InfutorGender')->nullable();
            $table->text('InfutorHomeOwner')->nullable();
            $table->text('InfutorLor')->nullable();
            $table->text('InfutorMarried')->nullable();
            $table->text('InfutorMedYrBld')->nullable();
            $table->text('InfutorMtgAmt')->nullable();
            $table->text('InfutorRoofCover')->nullable();
            $table->text('InfutorRoofType')->nullable();
            $table->text('InfutorSaleAmt')->nullable();
            $table->text('InfutorState')->nullable();
            $table->text('InfutorTaxAmt')->nullable();
            $table->text('InfutorVehicle2Make')->nullable();
            $table->text('InfutorVehicle2Model')->nullable();
            $table->text('InfutorVehicle2Year')->nullable();
            $table->text('InfutorVehicle3Make')->nullable();
            $table->text('InfutorVehicle3Model')->nullable();
            $table->text('InfutorVehicle3Year')->nullable();
            $table->text('InfutorVehicleMake')->nullable();
            $table->text('InfutorVehicleModel')->nullable();
            $table->text('InfutorVehicleYear')->nullable();
            $table->text('InfutorWealthScr')->nullable();
            $table->text('InsuranceCarrier')->nullable();
            $table->text('InsurancePurpose')->nullable();
            $table->text('InsuranceType')->nullable();
            $table->text('Interest')->nullable();
            $table->text('IsMarried')->nullable();
            $table->text('IsPrimaryResidence')->nullable();
            $table->text('IsSolarZip')->nullable();
            $table->text('IsTabaccoUser')->nullable();
            $table->text('IsTextable')->nullable();
            $table->text('LastClickDate')->nullable();
            $table->text('LastOpenDate')->nullable();
            $table->text('LateOnMortgageMonths')->nullable();
            $table->text('LicenseStatus')->nullable();
            $table->text('LoanPurpose')->nullable();
            $table->text('LoanToValue')->nullable();
            $table->text('LookingToExpandFamily')->nullable();
            $table->text('MaritalStatus')->nullable();
            $table->text('MarriedSingle')->nullable();
            $table->text('MedicareEnrolled')->nullable();
            $table->text('MilitaryService')->nullable();
            $table->text('MortgageCurrentLoanType')->nullable();
            $table->text('MortgageInsurance')->nullable();
            $table->text('MortgageLoanPurpose')->nullable();
            $table->text('MortgageRefinancePurpose')->nullable();
            $table->text('MovingTimeFrame')->nullable();
            $table->text('NewPropertyCity')->nullable();
            $table->text('NewPropertyState')->nullable();
            $table->text('NewPropertyZipcode')->nullable();
            $table->text('NumberOfBathrooms')->nullable();
            $table->text('NumberOfBedrooms')->nullable();
            $table->text('NumberOfChildrenInHouse')->nullable();
            $table->text('NumberOfPeopleInHouse')->nullable();
            $table->text('NumberOfStories')->nullable();
            $table->text('NumberOfVehicles')->nullable();
            $table->text('Occupation')->nullable();
            $table->text('OpenRate')->nullable();
            $table->text('OwnedLeasedOrFinanced')->nullable();
            $table->text('OwnOrRent')->nullable();
            $table->text('PageId')->nullable();
            $table->text('PolicyStartDate')->nullable();
            $table->text('ProfessionalInstall')->nullable();
            $table->text('Project')->nullable();
            $table->text('ProjectTimeFrame')->nullable();
            $table->text('ProjectType')->nullable();
            $table->text('PropertyType')->nullable();
            $table->text('RefinancePurpose')->nullable();
            $table->text('Residential')->nullable();
            $table->text('ReverseMortgage')->nullable();
            $table->text('RoofingMaterial')->nullable();
            $table->text('SellHouse')->nullable();
            $table->text('SellingReason')->nullable();
            $table->text('ServiceType')->nullable();
            $table->text('Shade')->nullable();
            $table->text('SignupId')->nullable();
            $table->text('SignupIdHash')->nullable();
            $table->text('SignupInsuranceAutoId')->nullable();
            $table->text('SignupMortgageId')->nullable();
            $table->text('SiteName')->nullable();
            $table->text('SiteVertical')->nullable();
            $table->text('SquareFootage')->nullable();
            $table->text('SubVerticalName')->nullable();
            $table->text('TcpaType')->nullable();
            $table->text('Tier')->nullable();
            $table->text('TotalLoanAmount')->nullable();
            $table->text('UUID')->nullable();
            $table->text('VehicleMake')->nullable();
            $table->text('VehicleMake2')->nullable();
            $table->text('VehicleModel')->nullable();
            $table->text('VehicleModel2')->nullable();
            $table->text('VehicleParkedAt')->nullable();
            $table->text('VehiclePrimaryUse')->nullable();
            $table->text('VehicleYear')->nullable();
            $table->text('VehicleYear2')->nullable();
            $table->text('Violation')->nullable();
            $table->text('WindowCount')->nullable();
            $table->text('WindowType')->nullable();
            $table->text('YearHomeBuilt')->nullable();
            $table->text('YearsInsured')->nullable();
            $table->string('stat', 10)->nullable();
            $table->string('newflag', 10)->nullable();
            $table->string('cleaned', 10)->nullable();
            $table->string('esp_api', 10)->nullable();
            $table->string('esp_str', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datasucobathremodel');
    }
};
