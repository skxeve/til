#!/bin/bash

project_id=$1

if [ "${project_id}" = "" ]; then
    echo "Usage: make.sh {gcp_project_id}"
    exit 1
fi

gcloud builds submit --tag gcr.io/${project_id}/helloworld

