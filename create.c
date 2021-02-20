#include <netdb.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/socket.h>

struct patient{/* structure of a patient going to be written to file*/
    int  patientNum;
    char fname[15];
    char lname[15];
    char date[11];
    char gender[2];
    char category[4];
    char officer[25];
};

int main(void)
{
    int i;
    int officer = 0;
    int count = 0;
    struct patient one = {0,"","","","","",""};
    FILE *fp = fopen("Mengo.dat","wb");
    if(fp == NULL){
        perror("failed: ");
        exit(0);
    }
    else{
        for(i=0; i<200;i++){
            fwrite(&one,sizeof(struct patient),1,fp);
            count = count + 1;
        }

        fwrite(&officer,sizeof(int),1,fp);
        fclose(fp);
    }
    return 0;
}
