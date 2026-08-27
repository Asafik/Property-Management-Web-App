<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PraLandbank;
use App\Models\DocumentTypes;
use App\Models\pra_landbank_documents;

class PraLandbankDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $praLandbanks = PraLandbank::all();
        $documentTypes = DocumentTypes::all();

        if ($praLandbanks->isEmpty() || $documentTypes->isEmpty()) {
            $this->command->warn('PraLandbank / DocumentTypes kosong!');
            return;
        }

        foreach ($praLandbanks as $land) {

            foreach ($documentTypes as $docType) {

                pra_landbank_documents::create([
                    'pra_landbank_id' => $land->id,
                    'document_type_id' => $docType->id,
                    'document_number' => 'DOC-' . strtoupper(uniqid()),
                    'file_path' => 'uploads/pra_landbank/sample/' . $docType->id . '.pdf',
                    'status' => 'pending',
                    'revision_number' => 0,
                ]);
            }
        }
    }
}