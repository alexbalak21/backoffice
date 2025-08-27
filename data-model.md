# Data Model Documentation

## Models

### User
Represents the system users with authentication capabilities.

**Table:** `users`

**Fields:**
- `id` - Primary key
- `name` - string
- `email` - string, unique
- `email_verified_at` - datetime, nullable
- `password` - string, hashed
- `remember_token` - string, nullable
- `created_at` - timestamp
- `updated_at` - timestamp

### Company
Represents companies in the system.

**Table:** `companies`

**Fields:**
- `id` - Primary key
- `name` - string
- `address` - string
- `recipient` - string
- `created_at` - timestamp
- `updated_at` - timestamp

### SampleAnalysis
Represents sample analysis records with detailed product and testing information.

**Table:** `sample_analyses`

**Fields:**
- `id` - Primary key
- `client` - string
- `sampling_date` - date
- `sampling_location` - string
- `lab_receipt_datetime` - datetime
- `receipt_temperature` - decimal(8,2)
- `storage_conditions` - string
- `analysis_date` - date
- `supplier_manufacturer` - string
- `packaging` - string
- `approval_number` - string
- `batch_number` - string
- `fishing_type` - string
- `product_name` - string
- `species` - string
- `origin` - string
- `packaging_date` - date
- `best_before_date` - date
- `imp` - string
- `hx` - string
- `nucleotide_note` - string
- `created_at` - timestamp
- `updated_at` - timestamp

**Casts:**
- `sampling_date` - date
- `lab_receipt_datetime` - datetime
- `analysis_date` - date
- `packaging_date` - date
- `best_before_date` - date
- `receipt_temperature` - decimal:2

## Relationships

Currently, there are no explicitly defined relationships between the models in the code. The models are using Laravel's default timestamps and basic functionality.

## Notes
- All models include Laravel's automatic timestamps (`created_at` and `updated_at`)
- The `User` model includes authentication features from `Authenticatable`
- `SampleAnalysis` includes type casting for date and decimal fields
- `Company` is a simple model with basic string fields
