CREATE PROCEDURE sp_blacksmith_statusCheck_GETLIST 
AS

SELECT 
    acra.uen
    ,acra.entity_name
    ,acra.entity_type_description
    ,acra.entity_status_description
    ,SUBSTRING(acra.registration_incorporation_date, 1, 10) as registration_incorporation_date
    ,acra.block + ' ' + acra.street_name + ', ' + acra.level_no + '-' + acra.unit_no + ' ' + acra.building_name + ', ' + acra.postal_code AS full_address
FROM allAcraRecords acra
WHERE acra.entity_status_description = 'na' AND acra.entity_type_description = 'Foreign Company'
ORDER BY acra.entity_name