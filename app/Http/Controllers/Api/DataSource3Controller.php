<?php

// working on  
namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewSubscriber3;
use AMGPortal\Http\Resources\DataResource3;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataSource3;


class DataSource3Controller extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewSubscriber3 $request
     * @return UserResource
     */
    public function store(CreateNewSubscriber3 $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'DataSourceID','Token','TokenPassword','EmailAddress','Vertical','LeadDate','LeadIPAddress','FirstName','LastName','MailAddress1','CityName','ProvinceStateName','PostalZipCode','PhoneNumber','PhoneSecondary','BirthDate','Gender','Accident','Age','AgeFirstLicensed','AgentFound','AnnualHouseholdIncome','AnnualMileage','AutoInsurance','BankruptcyForeclosure','CarrierName','CarrierType','CashNeeded','CashNeededAmount','CkmAffiliateId','CkmCampaignId','CkmOfferId','CkmSubId1','ComeHomeUrl','CreditRating','CreditRepairRequested','CurrentLender','CurrentLenderOriginal','CurrentLoanAmount','CurrentLoanType','CurrentlyInsured','CurrentMortgageRate','DesiredCoverage','DesiredHvac','DesireHomeownersInsurance','DoesDangerActivities','DoesRequireSR22','DriverVehicleUsageId','Education','ElectricBill','ElectricCompany','EmploymentStatus','EstimatedDebt','EstimatedDownPayment','EstimatedPropertyValue','EstimatedPurchasePrice','ExpirationDate','FacebookId','FinanceCurrentLoanType','FinanceLoanPurpose','FinanceRefinancePurpose','FoundHome','FullName','HasAlarmInstalled','HasConditions','HasHighBMI','HasInsuranceClaims','HasLifeEvent','HasSolar','HomeInsurance','HundredKUse','InfutorAge','InfutorDwellType','InfutorEhi','InfutorGender','InfutorHomeOwner','InfutorLor','InfutorMarried','InfutorMedYrBld','InfutorMtgAmt','InfutorRoofCover','InfutorRoofType','InfutorSaleAmt','InfutorState','InfutorTaxAmt','InfutorVehicle2Make','InfutorVehicle2Model','InfutorVehicle2Year','InfutorVehicle3Make','InfutorVehicle3Model','InfutorVehicle3Year','InfutorVehicleMake','InfutorVehicleModel','InfutorVehicleYear','InfutorWealthScr','InsuranceCarrier','InsurancePurpose','InsuranceType','Interest','IsMarried','IsPrimaryResidence','IsSolarZip','IsTabaccoUser','IsTextable','LastClickDate','LastOpenDate','LateOnMortgageMonths','LicenseStatus','LoanPurpose','LoanToValue','LookingToExpandFamily','MaritalStatus','MarriedSingle','MedicareEnrolled','MilitaryService','MortgageCurrentLoanType','MortgageInsurance','MortgageLoanPurpose','MortgageRefinancePurpose','MovingTimeFrame','NewPropertyCity','NewPropertyState','NewPropertyZipcode','NumberOfBathrooms','NumberOfBedrooms','NumberOfChildrenInHouse','NumberOfPeopleInHouse','NumberOfStories','NumberOfVehicles','Occupation','OpenRate','OwnedLeasedOrFinanced','OwnOrRent','PageId','PolicyStartDate','ProfessionalInstall','Project','ProjectTimeFrame','ProjectType','PropertyType','RefinancePurpose','Residential','ReverseMortgage','RoofingMaterial','SellHouse','SellingReason','ServiceType','Shade','SignupId','SignupIdHash','SignupInsuranceAutoId','SignupMortgageId','SiteName','SiteVertical','SquareFootage','SubVerticalName','TcpaType','Tier','TotalLoanAmount','UUID','VehicleMake','VehicleMake2','VehicleModel','VehicleModel2','VehicleParkedAt','VehiclePrimaryUse','VehicleYear','VehicleYear2','Violation','WindowCount','WindowType','YearHomeBuilt','YearsInsured'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataSource3::create($data);

        return new DataResource3($user);
    }
}
