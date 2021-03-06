CREATE PROCEDURE sp_blacksmith_companyName_GETLIST 
   @entityName nvarchar(50)
AS

/*
DECLARE @entityName AS nvarchar(50)
SET @entityName='ING BANK N.V.'
--*/

SELECT 
    acra.uen
    ,acra.entity_name
    ,acra.entity_type_description
    ,acra.entity_status_description
    ,SUBSTRING(acra.registration_incorporation_date, 1, 10) as registration_incorporation_date
    ,acra.block + ' ' + acra.street_name + ', ' as [street_name_concat]
    ,acra.level_no + '-' + acra.unit_no + ' ' + acra.building_name + ', ' as [building_name_concat]
    ,acra.postal_code
FROM allAcraRecords acra
WHERE acra.entity_name LIKE '%' + @entityName + '%'
ORDER BY acra.entity_name