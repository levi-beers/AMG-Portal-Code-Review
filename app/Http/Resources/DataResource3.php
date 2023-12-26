<?php

namespace AMGPortal\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DataResource3 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'EmailAddress' => $this->EmailAddress,
            'DataSourceID' => $this->DataSourceID,
            'Token' => $this->Token,
            'TokenPassword' => $this->TokenPassword,
            'Vertical' => $this->Vertical,
            'LeadDate' => $this->LeadDate,
            'LeadIPAddress' => $this->LeadIPAddress,
            'FirstName' => $this->FirstName,
            'LastName' => $this->LastName,
            'MailAddress1' => $this->MailAddress1,
            'CityName' => $this->CityName,
            'ProvinceStateName' => $this->ProvinceStateName,
            'PostalZipCode' => $this->PostalZipCode,
            'PhoneNumber' => $this->PhoneNumber,
            'PhoneSecondary' => $this->PhoneSecondary,
            'BirthDate' => $this->BirthDate,
            'Gender' => $this->Gender,
            'Accident' => $this->Accident,
            'Age' => $this->Age,
            'AgeFirstLicensed' => $this->AgeFirstLicensed,
            'AgentFound' => $this->AgentFound,
            'AnnualHouseholdIncome' => $this->AnnualHouseholdIncome,
            'AnnualMileage' => $this->AnnualMileage,
            'AutoInsurance' => $this->AutoInsurance,
            'BankruptcyForeclosure' => $this->BankruptcyForeclosure,
            'CarrierName' => $this->CarrierName,
            'CarrierType' => $this->CarrierType,
            'CashNeeded' => $this->CashNeeded,
            'CashNeededAmount' => $this->CashNeededAmount,
            'CkmAffiliateId' => $this->CkmAffiliateId,
            'CkmCampaignId' => $this->CkmCampaignId,
            'CkmOfferId' => $this->CkmOfferId,
            'CkmSubId1' => $this->CkmSubId1,
            'ComeHomeUrl' => $this->ComeHomeUrl,
            'CreditRating' => $this->CreditRating,
            'CreditRepairRequested' => $this->CreditRepairRequested,
            'CurrentLender' => $this->CurrentLender,
            'CurrentLenderOriginal' => $this->CurrentLenderOriginal,
            'CurrentLoanAmount' => $this->CurrentLoanAmount,
            'CurrentLoanType' => $this->CurrentLoanType,
            'CurrentlyInsured' => $this->CurrentlyInsured,
            'CurrentMortgageRate' => $this->CurrentMortgageRate,
            'DesiredCoverage' => $this->DesiredCoverage,
            'DesiredHvac' => $this->DesiredHvac,
            'DesireHomeownersInsurance' => $this->DesireHomeownersInsurance,
            'DoesDangerActivities' => $this->DoesDangerActivities,
            'DoesRequireSR22' => $this->DoesRequireSR22,
            'DriverVehicleUsageId' => $this->DriverVehicleUsageId,
            'Education' => $this->Education,
            'ElectricBill' => $this->ElectricBill,
            'ElectricCompany' => $this->ElectricCompany,
            'EmploymentStatus' => $this->EmploymentStatus,
            'EstimatedDebt' => $this->EstimatedDebt,
            'EstimatedDownPayment' => $this->EstimatedDownPayment,
            'EstimatedPropertyValue' => $this->EstimatedPropertyValue,
            'EstimatedPurchasePrice' => $this->EstimatedPurchasePrice,
            'ExpirationDate' => $this->ExpirationDate,
            'FacebookId' => $this->FacebookId,
            'FinanceCurrentLoanType' => $this->FinanceCurrentLoanType,
            'FinanceLoanPurpose' => $this->FinanceLoanPurpose,
            'FinanceRefinancePurpose' => $this->FinanceRefinancePurpose,
            'FoundHome' => $this->FoundHome,
            'FullName' => $this->FullName,
            'HasAlarmInstalled' => $this->HasAlarmInstalled,
            'HasConditions' => $this->HasConditions,
            'HasHighBMI' => $this->HasHighBMI,
            'HasInsuranceClaims' => $this->HasInsuranceClaims,
            'HasLifeEvent' => $this->HasLifeEvent,
            'HasSolar' => $this->HasSolar,
            'HomeInsurance' => $this->HomeInsurance,
            'HundredKUse' => $this->HundredKUse,
            'InfutorAge' => $this->InfutorAge,
            'InfutorDwellType' => $this->InfutorDwellType,
            'InfutorEhi' => $this->InfutorEhi,
            'InfutorGender' => $this->InfutorGender,
            'InfutorHomeOwner' => $this->InfutorHomeOwner,
            'InfutorLor' => $this->InfutorLor,
            'InfutorMarried' => $this->InfutorMarried,
            'InfutorMedYrBld' => $this->InfutorMedYrBld,
            'InfutorMtgAmt' => $this->InfutorMtgAmt,
            'InfutorRoofCover' => $this->InfutorRoofCover,
            'InfutorRoofType' => $this->InfutorRoofType,
            'InfutorSaleAmt' => $this->InfutorSaleAmt,
            'InfutorState' => $this->InfutorState,
            'InfutorTaxAmt' => $this->InfutorTaxAmt,
            'InfutorVehicle2Make' => $this->InfutorVehicle2Make,
            'InfutorVehicle2Model' => $this->InfutorVehicle2Model,
            'InfutorVehicle2Year' => $this->InfutorVehicle2Year,
            'InfutorVehicle3Make' => $this->InfutorVehicle3Make,
            'InfutorVehicle3Model' => $this->InfutorVehicle3Model,
            'InfutorVehicle3Year' => $this->InfutorVehicle3Year,
            'InfutorVehicleMake' => $this->InfutorVehicleMake,
            'InfutorVehicleModel' => $this->InfutorVehicleModel,
            'InfutorVehicleYear' => $this->InfutorVehicleYear,
            'InfutorWealthScr' => $this->InfutorWealthScr,
            'InsuranceCarrier' => $this->InsuranceCarrier,
            'InsurancePurpose' => $this->InsurancePurpose,
            'InsuranceType' => $this->InsuranceType,
            'Interest' => $this->Interest,
            'IsMarried' => $this->IsMarried,
            'IsPrimaryResidence' => $this->IsPrimaryResidence,
            'IsSolarZip' => $this->IsSolarZip,
            'IsTabaccoUser' => $this->IsTabaccoUser,
            'IsTextable' => $this->IsTextable,
            'LastClickDate' => $this->LastClickDate,
            'LastOpenDate' => $this->LastOpenDate,
            'LateOnMortgageMonths' => $this->LateOnMortgageMonths,
            'LicenseStatus' => $this->LicenseStatus,
            'LoanPurpose' => $this->LoanPurpose,
            'LoanToValue' => $this->LoanToValue,
            'LookingToExpandFamily' => $this->LookingToExpandFamily,
            'MaritalStatus' => $this->MaritalStatus,
            'MarriedSingle' => $this->MarriedSingle,
            'MedicareEnrolled' => $this->MedicareEnrolled,
            'MilitaryService' => $this->MilitaryService,
            'MortgageCurrentLoanType' => $this->MortgageCurrentLoanType,
            'MortgageInsurance' => $this->MortgageInsurance,
            'MortgageLoanPurpose' => $this->MortgageLoanPurpose,
            'MortgageRefinancePurpose' => $this->MortgageRefinancePurpose,
            'MovingTimeFrame' => $this->MovingTimeFrame,
            'NewPropertyCity' => $this->NewPropertyCity,
            'NewPropertyState' => $this->NewPropertyState,
            'NewPropertyZipcode' => $this->NewPropertyZipcode,
            'NumberOfBathrooms' => $this->NumberOfBathrooms,
            'NumberOfBedrooms' => $this->NumberOfBedrooms,
            'NumberOfChildrenInHouse' => $this->NumberOfChildrenInHouse,
            'NumberOfPeopleInHouse' => $this->NumberOfPeopleInHouse,
            'NumberOfStories' => $this->NumberOfStories,
            'NumberOfVehicles' => $this->NumberOfVehicles,
            'Occupation' => $this->Occupation,
            'OpenRate' => $this->OpenRate,
            'OwnedLeasedOrFinanced' => $this->OwnedLeasedOrFinanced,
            'OwnOrRent' => $this->OwnOrRent,
            'PageId' => $this->PageId,
            'PolicyStartDate' => $this->PolicyStartDate,
            'ProfessionalInstall' => $this->ProfessionalInstall,
            'Project' => $this->Project,
            'ProjectTimeFrame' => $this->ProjectTimeFrame,
            'ProjectType' => $this->ProjectType,
            'PropertyType' => $this->PropertyType,
            'RefinancePurpose' => $this->RefinancePurpose,
            'Residential' => $this->Residential,
            'ReverseMortgage' => $this->ReverseMortgage,
            'RoofingMaterial' => $this->RoofingMaterial,
            'SellHouse' => $this->SellHouse,
            'SellingReason' => $this->SellingReason,
            'ServiceType' => $this->ServiceType,
            'Shade' => $this->Shade,
            'SignupId' => $this->SignupId,
            'SignupIdHash' => $this->SignupIdHash,
            'SignupInsuranceAutoId' => $this->SignupInsuranceAutoId,
            'SignupMortgageId' => $this->SignupMortgageId,
            'SiteName' => $this->SiteName,
            'SiteVertical' => $this->SiteVertical,
            'SquareFootage' => $this->SquareFootage,
            'SubVerticalName' => $this->SubVerticalName,
            'TcpaType' => $this->TcpaType,
            'Tier' => $this->Tier,
            'TotalLoanAmount' => $this->TotalLoanAmount,
            'UUID' => $this->UUID,
            'VehicleMake' => $this->VehicleMake,
            'VehicleMake2' => $this->VehicleMake2,
            'VehicleModel' => $this->VehicleModel,
            'VehicleModel2' => $this->VehicleModel2,
            'VehicleParkedAt' => $this->VehicleParkedAt,
            'VehiclePrimaryUse' => $this->VehiclePrimaryUse,
            'VehicleYear' => $this->VehicleYear,
            'VehicleYear2' => $this->VehicleYear2,
            'Violation' => $this->Violation,
            'WindowCount' => $this->WindowCount,
            'WindowType' => $this->WindowType,
            'YearHomeBuilt' => $this->YearHomeBuilt,
            'YearsInsured' => $this->YearsInsured
        ];
    }
}
