ALTER TABLE {{conn|qtIdent(data.schema, data.table)}} DROP COLUMN {{conn|qtIdent(data.name)}};