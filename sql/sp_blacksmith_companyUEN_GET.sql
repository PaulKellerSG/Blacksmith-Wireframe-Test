CREATE PROCEDURE sp_blacksmith_companyUEN_GET 
   @uen nvarchar(50)
AS

/*
DECLARE @uen nvarchar(50)
SET @uen='S87FC3803K' --ING
SET @uen='196800306E' --DBS
SET @uen='S89FC4069A' --COMMERZBANK
--*/

SELECT 
    acra.uen
    ,acra.entity_name
    ,acra.entity_type_description
    ,acra.entity_status_description
    ,SUBSTRING(acra.registration_incorporation_date, 1, 10) as registration_incorporation_date
    ,acra.block + ' ' + acra.street_name + ', ' + acra.level_no + '-' + acra.unit_no + ' ' + acra.building_name + ', ' + acra.postal_code AS full_address
FROM allAcraRecords acra
WHERE acra.uen=@uen
ORDER BY acra.entity_name