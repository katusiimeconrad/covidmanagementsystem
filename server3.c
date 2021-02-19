#include <stdio.h>
#include <stdlib.h>
#include <netdb.h> 
#include <netinet/in.h>
#include <unistd.h> 
#include <stdlib.h> 
#include <string.h> 
#include <sys/socket.h> 
#include <sys/types.h>
#define MAX 80
#define PORT 8082
#define SA struct sockaddr 

struct patient{           /* structure of a patient going to be written to file*/
    int  patientNum;   
    char fname[10];
    char lname[10];
    char date[11];
    char gender[2];
    char category[4];
    char officer[25]; 
};


void patientDetails(int sockfd){
    char buff[60];//used to store the incoming messages
    char buff2[60];//used to store the outgoing messages.    
    char hospital[15];//used to store hospital
    char temphospital[15];//temporary hospital holder
    char hosp[15];
    char name[15];//used to store name
    int check = 0;// used to check if a criteria is matched 
    int len = 0; //length of a buff copied into a variable
    char fun[60];//choosing a function
    char fun2[60];//used to copy function into another buffer
    char func[15];//name of function e.g search, add patient, check status is copied into this variable
	char *ptr = NULL;//a pointer to the function
    char *ptr2 = NULL;//a pointer to be used
    char delim[] = " ";// used when splitting string based on spaces 
    char delim2[] = "";//delimitor 2 to separate string with '/0'
    char delim3[] = ",";//delimitor 3 to separate string with ','
    char *textFile; //search if the patients are being added by file or by a command.  

    //AUTHENTCATE hospital
    do{
        read(sockfd, buff, sizeof(buff));
        strcpy(hospital,buff);
        len = strlen(hospital);
        if(hospital[len-1] == '\n')
            hospital[len-1] =0;

       if(strcmp(hospital,"Mengo") == 0 || strcmp(hospital,"Mbuya") == 0 ||  strcmp(hospital,"Makerere") == 0 || strcmp(hospital,"Ruhoma") == 0 || strcmp(hospital,"Bufumbo") == 0 || strcmp(hospital,"Ngoma") == 0 || strcmp(hospital,"Kiruddu") == 0){
            strcpy(buff2,"valid");
            check = 1;
        }
        else{
            strcpy(buff2, "invalid");
            check = 0;
        }
        write(sockfd,buff2, sizeof(buff2));
    }while(check == 0);


    //AUTHENTICATE NAME
    do{
        //read name from socket store in buff storage
        read(sockfd, buff, sizeof(buff));
        //copy name from buffer to name variable
        strcpy(name,buff);
        //used to remove the pesky last character so as to much comparison
        len = strlen(name);
        if(name[len-1] == '\n')
            name[len-1] =0;

        //compare of name is a for valid user
        if(strcmp(name,"Kigula Jesse") == 0 || strcmp(name,"Ssembatya Isaac") == 0 || strcmp(name,"Namayanja Zahara") || strcmp(name,"Katusiime Conrad") || strcmp(name,"Tumuhairwe Bruno") ){
            strcpy(buff2,"Valid Name");
            check = 1;
        }
        else{
            strcpy(buff2, "falseName");
            check = 0;
        }
        write(sockfd,buff2, sizeof(buff2));
        printf("%d", check);
    }while(check == 0);

    //FUNCTIONS e.g search, check_status, addfile.
    do{
        struct patient one = {0,"","","","","",""};
        strcpy(hosp,hospital);
        strcpy(temphospital,hospital);
        //remove that pesky \n symbol       
        read(sockfd, buff, sizeof(buff));
        strcpy(fun,buff);
        len = strlen(fun);
        if(fun[len-1] == '\n')
            fun[len-1] =0;

        strcpy(fun2,fun);//to remain with original function
        ptr = strtok(fun2,delim);//copy of function to modify and work with
        strcpy(func,ptr);
        ptr = strtok(NULL,delim2);
    
        //add patient individually or through file
        if(strcmp(func,"Addpatient") == 0){
            textFile = strstr(ptr,".txt");
            if(textFile){//for insertion from textfile
                int officer;
                char buff[201];
                char buff2[201];
                char filename[255] = "";
                strcat(filename,ptr);
                char filename2[255] = "";
                strcat(hospital,".dat");
                strcat(filename2,hospital);
                FILE *fp = fopen(filename,"r"); if(fp==NULL){perror("Failed to open' ");}//text file to be uploaded by the agent
                FILE *fp2 = fopen(filename2,"rb+"); if(fp2==NULL){perror("Failed to open' ");}//data file to which member structure is to be uploaded
                do{
                    struct patient one = {0,"","","","","",""};
                    fgets(buff,201,fp);
                    len = strlen(buff);
                    if(buff[len-1] == '\n')
                        buff[len-1] =0;//get rid of that pesky newline character =)
                    
                    ptr2 = strtok(buff,delim);
                    while(ptr2 != NULL){ //copying the buff contents into the structure member
                        if(ptr2 != NULL)
                            strcpy(buff2,ptr2);
                        if(strcmp(one.fname,"")==0) { strcpy(one.fname,buff2);; printf(" %s",one.fname);}
                        else if(strcmp(one.lname,"")==0) {strcpy(one.lname,buff2); printf(" %s",one.lname);}
                        else if(strcmp(one.date,"")==0) {strcpy(one.date,buff2);printf(" %s",one.date);}
                        else if(strcmp(one.gender,"")==0){strcpy(one.gender,buff2); printf(" %s",one.gender);}
                        else if(strcmp(one.category,"")==0) {strcpy(one.category,buff2);strcpy(one.officer,name);printf(" %s",one.category);printf(" %s\n",one.officer);}
                        strcpy(buff2,"");
                        ptr2 = strtok(NULL,delim);                          
                    }

                    fseek(fp2,-4,SEEK_END);
                    fread(&officer,sizeof(int),1,fp2);
                    one.patientNum = officer;//The position the member structure is going to be uploaded to in the file
                    officer++;
                    fseek(fp2,-4,SEEK_END);
                    fwrite(&officer,sizeof(int),1,fp2); 
                    fseek(fp2, (one.patientNum) * sizeof(struct patient),SEEK_SET);//uploading the member structure to its position
                    fwrite(&one,sizeof(struct patient),1,fp2); 
                    if(feof(fp))
                        break;  
                }while(1);
                fclose(fp2);
                fclose(fp);
                fp = fopen(filename,"w"); if(fp==NULL){perror("Failed to open' ");exit(1);}//delete items in txt file
                fclose(fp);
            }
            else{//for individual member insertion
                char buff[201]="";
                int officer;
                ptr2 = strtok(ptr,delim);
                strcpy(one.fname,ptr2);
                ptr2 =strtok(NULL,delim3);
                while(ptr2 != NULL){// copying the buff contents into the structure member
                    if(ptr2 != NULL)
                        strcpy(buff,ptr2);
                    if(strcmp(one.lname,"")==0) {strcpy(one.lname,buff);}
                    else if(strcmp(one.date,"")==0) {strcpy(one.date,buff);}
                    else if(strcmp(one.gender,"")==0){strcpy(one.gender,buff);}
                    else if(strcmp(one.category,"")==0) {strcpy(one.category,buff);strcpy(one.officer,name);}
                    strcpy(buff,"");
                    ptr2 = strtok(NULL,delim3);                          
                }
                //strcpy(hosp,hospital);

                //specify file path
                char filename2[255] = "";
                //get specific hospital/ hospital
                strcat(temphospital, ".dat");
                strcat(filename2,temphospital);
                
                //open file
                FILE *fp2 = fopen(filename2,"rb+"); if(fp2==NULL){printf("%s",filename2);perror("Failed to open' ");exit(1);}
                //get last record number stored on file
                fseek(fp2,-4,SEEK_END);
                fread(&officer,sizeof(int),1,fp2);
                //The position the patient structure is going to be uploaded to in the file
                one.patientNum = officer;
                officer++;
                fseek(fp2,-4,SEEK_END);
                fwrite(&officer,sizeof(int),1,fp2); 
                //calculate where to insert new values
                fseek(fp2, (one.patientNum) * sizeof(struct patient),SEEK_SET);
                //uploading the patient structure to its position
                fwrite(&one,sizeof(struct patient),1,fp2);
                fclose(fp2);
            }
        }
        //search based on fname, lname or date
        else if(strcmp(func,"Search") == 0){
            int i =0;
            char buff[201];
            char buff2[255] = ""; 
            char filename2[255] = "";
            strcat(temphospital,".dat");
            strcat(filename2,temphospital);
            FILE *fp2 = fopen(filename2,"rb+"); if(fp2==NULL){perror("Failed to open' ");exit(1);}//text file to be uploaded by the agent
            strcpy(buff,ptr);
            int count = 0;
            while(count < 200){
                fread(&one,sizeof(struct patient),1,fp2);
                if((strcmp(buff,one.fname) == 0)||(strcmp(buff,one.date) == 0)||(strcmp(buff,one.lname) == 0)){
                    strcat(buff2,one.fname);
                    strcat(buff2," ");
                    strcat(buff2,one.lname);
                    strcat(buff2," ");
                    strcat(buff2,one.date);
                    strcat(buff2," ");
                    strcat(buff2,one.gender);
                    strcat(buff2," ");
                    strcat(buff2,one.category);
                    strcat(buff2," ");
                    strcat(buff2,one.officer);
                    strcat(buff2,"\n");
                }
                count++;
            }
            strcat(buff2,"\n");
            write(sockfd, buff2, sizeof(buff2));
            fclose(fp2);
        }
        else if(strcmp(fun,"Check_status") == 0){
            int officer;
            char snum[5];
            char filename2[255] = "";
            //get specific hospital/ hospital
            strcat(temphospital, ".dat");
            strcat(filename2,temphospital);
            //open file
            FILE *fp2 = fopen(filename2,"rb+"); if(fp2==NULL){printf("%s",filename2);perror("Failed to open' ");exit(1);}
            //get last record number stored on file
            fseek(fp2,-4,SEEK_END);
            fread(&officer,sizeof(int),1,fp2);
            
            sprintf(snum, "%d", officer); 
            strcpy(buff2,snum);
            write(sockfd, buff2, sizeof(buff2));
            fclose(fp2);
            

        }
        strcpy(hospital,hosp);     
    }while(strcmp(fun,"exit") != 0);


}

int main(){
    int sockfd, connfd, len;
    struct sockaddr_in servaddr, cli;

    sockfd = socket(AF_INET, SOCK_STREAM, 0);
    if(sockfd == -1){
        printf("socket creation failed... \n");
        exit(0);
    }
    else
        printf("Socket successfully created..\n");
    bzero((&servaddr), sizeof(servaddr));

    // assign IP, PORT 
	servaddr.sin_family = AF_INET; //match socket call
	servaddr.sin_addr.s_addr = htonl(INADDR_ANY); //bind to any local address
	servaddr.sin_port = htons(PORT); //specify port to listen on. htons is a converter
   
    int tr=1;
   if(setsockopt(sockfd,SOL_SOCKET,SO_REUSEADDR,&tr,sizeof(int)) == -1){
      perror("setsockopt");
      exit(1);
   }
      
   // Binding newly created socket to given IP and verification 
	if ((bind(sockfd, (SA*)&servaddr, sizeof(servaddr))) != 0){ 
		perror("socket bind failed"); 
		exit(0); 
	} 
	else
		printf("Socket successfully binded..\n"); 

	// Now server is ready to listen and verification 
	if ((listen(sockfd, 5)) != 0) { 
	        printf("Listen failed...\n"); 
		exit(0); 
	} 
	else
		printf("Server listening..\n"); 
	len = sizeof(cli); 

	// Accept the data packet from client and verification 
	connfd = accept(sockfd, (SA*)&cli, &len); 
	if (connfd < 0) { 
		printf("server acccept failed...\n"); 
		exit(0); 
	} 
	else
		printf("server acccept the client...\n"); 

    patientDetails(connfd);

	// After chatting close the socket 
	close(sockfd);
}